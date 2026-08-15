<?php

namespace App\Tests\Functional;

use App\Entity\Character;
use App\Entity\Outfit;
use App\Entity\Pose;
use App\Entity\PromptComposition;
use App\Entity\Scene;
use App\Enum\CompositionStatusEnum;
use App\Service\PromptCompiler;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PersistenceAndRegressionTest extends WebTestCase
{
    private EntityManagerInterface $em;
    private SchemaTool $schemaTool;
    private KernelBrowser $client;

    /** @var list<string> */
    private const EXPECTED_TABLES = [
        'character',
        'garment',
        'garment_slot',
        'lighting',
        'outfit',
        'pose',
        'prompt_composition',
        'scene',
    ];

    private const UUID_V4 = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    protected function setUp(): void
    {
        parent::setUp();

        // Booting the kernel once per test also gives us the HTTP client and the
        // in-memory SQLite database connection (via the test container below).
        $this->client = static::createClient();

        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
        $this->schemaTool = new SchemaTool($this->em);

        $classes = $this->em->getMetadataFactory()->getAllMetadata();
        $this->schemaTool->dropSchema($classes);
        $this->schemaTool->createSchema($classes);
    }

    public function testEightTablesAreCreatedFromMappings(): void
    {
        $tables = array_map(
            'strtolower',
            $this->em->getConnection()->createSchemaManager()->listTableNames()
        );

        self::assertSame(self::EXPECTED_TABLES, $tables);
    }

    public function testMappingSchemaIsInSyncWithMigrations(): void
    {
        // getUpdateSchemaSql() returns the DDL needed to bring the database in line with the
        // mappings; an empty list means the schema created in setUp has no pending changes,
        // i.e. the Doctrine mappings are fully in sync with the database schema.
        $classes = $this->em->getMetadataFactory()->getAllMetadata();
        $diffSql = (new SchemaTool($this->em))->getUpdateSchemaSql($classes);

        self::assertSame([], $diffSql);
    }

    public function testPersistCompositionWithAllCardinalityAndUuidV4(): void
    {
        $character = (new Character())
            ->setName('Luna')
            ->setGender('FEMALE')
            ->setAge(28)
            ->setEthnicity('CAUCASIAN');

        $outfit = (new Outfit())
            ->setName('Studio casual')
            ->setStyleCategory('CASUAL');

        $pose = (new Pose())
            ->setTitle('Three quarter view')
            ->setCategory('PORTRAIT')
            ->setBodyLanguage('Neutral stance')
            ->setFacialExpression('Neutral')
            ->setExpressionIntensity(5);

        $scene = (new Scene())
            ->setTitle('Soft window light')
            ->setEnvironmentType('INDOOR')
            ->setLocationDetails('by a north-facing window');

        $composition = (new PromptComposition())
            ->setTitle('Luna studio portrait')
            ->setUserId('test-user')
            ->setStatus(CompositionStatusEnum::DRAFT)
            ->setTargetModelHint('FLUX_1_DEV')
            ->setCharacter($character)
            ->setOutfit($outfit)
            ->setPose($pose)
            ->setScene($scene);

        foreach ([$character, $outfit, $pose, $scene, $composition] as $entity) {
            $this->em->persist($entity);
        }
        $this->em->flush();

        $id = $composition->getId();

        // Regression: UuidIdentity uses Uuid::v4()->toRfc4122() (not the removed toRfc4122String()).
        self::assertMatchesRegularExpression(self::UUID_V4, (string) $id);

        $loaded = $this->em->getRepository(PromptComposition::class)->find($id);
        self::assertNotNull($loaded);
        self::assertSame($id, $loaded->getId());
        self::assertNotNull($loaded->getCharacter());
        self::assertSame('Luna', $loaded->getCharacter()->getName());
        self::assertNotNull($loaded->getOutfit());
        self::assertSame('Studio casual', $loaded->getOutfit()->getName());
        self::assertNotNull($loaded->getPose());
        self::assertSame('Three quarter view', $loaded->getPose()->getTitle());
        self::assertNotNull($loaded->getScene());
        self::assertSame('Soft window light', $loaded->getScene()->getTitle());
    }

    public function testPromptCompilerConsumesPersistedCompositionId(): void
    {
        // Regression for toRfc4122() in the compiler + UuidIdentity: a persisted composition id
        // must round-trip through PromptCompiler::compile() unchanged.
        $composition = (new PromptComposition())
            ->setTitle('Compiler id passthrough')
            ->setUserId('test-user')
            ->setStatus(CompositionStatusEnum::DRAFT)
            ->setTargetModelHint('FLUX_1_DEV');

        $this->em->persist($composition);
        $this->em->flush();

        $compiler = self::getContainer()->get(PromptCompiler::class);
        $result = $compiler->compile(
            ['character' => ['name' => 'Luna']],
            $composition->getId(),
            'FLUX_1_DEV'
        );

        self::assertSame($composition->getId(), $result['meta']['composition_id']);
        self::assertMatchesRegularExpression(self::UUID_V4, $result['meta']['composition_id']);
    }

    public function testCompileRouteGrantsAuthenticatedUserAndDeniesAnonymous(): void
    {
        // Regression for the IS_AUTHENTICATED_REMEMBERING (note the trailing -ING) typo that
        // previously made the firewall deny *every* authenticated /api request with 403.
        $client = $this->client;

        // Anonymous => denied (not 200)
        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['composition' => ['character' => ['name' => 'Luna']]]));
        self::assertContains($client->getResponse()->getStatusCode(), [401, 403]);

        // Login => authenticated session
        $client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['email' => 'admin@example.com', 'password' => 'password']));
        self::assertSame(200, $client->getResponse()->getStatusCode());

        // Authenticated => granted (200), the regression that was 403 under the -ING typo
        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['composition' => ['character' => ['name' => 'Luna']]]));
        self::assertSame(200, $client->getResponse()->getStatusCode());
    }
}
