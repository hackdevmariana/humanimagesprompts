<?php

namespace App\Tests\Functional;

use App\Entity\Character;
use App\Entity\Outfit;
use App\Entity\Pose;
use App\Entity\PromptComposition;
use App\Entity\Scene;
use App\Enum\CompositionStatusEnum;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class PersistenceAndRegressionTest extends DatabaseTestCase
{
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
        // mappings; an empty list means the schema created in setUp has no pending changes.
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

        $compiler = self::getContainer()->get(\App\Service\PromptCompiler::class);
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
        // Regression for the IS_AUTHENTICATED_REMEMBERING (trailing -ING) typo that previously
        // made the firewall deny *every* authenticated /api request with 403.
        $client = $this->client;

        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['composition' => ['character' => ['name' => 'Luna']]]));
        self::assertContains($client->getResponse()->getStatusCode(), [401, 403]);

        $client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['email' => 'admin@example.com', 'password' => 'password']));
        self::assertSame(200, $client->getResponse()->getStatusCode());

        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['composition' => ['character' => ['name' => 'Luna']]]));
        self::assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testCompileLoadsPersistedCompositionFromDatabase(): void
    {
        // Phase C regression: POST /api/compile resolves composition_id against a persisted
        // PromptComposition + its character and feeds the real saved values to the compiler.
        $character = (new Character())
            ->setName('Elena')
            ->setGender('FEMALE')
            ->setAge(26)
            ->setEthnicity('CAUCASIAN');

        $scene = (new Scene())
            ->setTitle('Golden hour rooftop')
            ->setEnvironmentType('URBAN')
            ->setLocationDetails('roof');

        foreach ([$character, $scene] as $entity) {
            $this->em->persist($entity);
        }

        $composition = (new PromptComposition())
            ->setTitle('Elena golden hour')
            ->setUserId('test-user')
            ->setStatus(CompositionStatusEnum::DRAFT)
            ->setTargetModelHint('FLUX_1_DEV')
            ->setCharacter($character)
            ->setScene($scene);

        $this->em->persist($composition);
        $this->em->flush();

        $client = $this->client;
        $this->login($client);

        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['composition_id' => $composition->getId()]));
        self::assertSame(200, $client->getResponse()->getStatusCode());

        $body = json_decode($client->getResponse()->getContent(), true);
        self::assertSame($composition->getId(), $body['meta']['composition_id']);
        // The persisted character's age (26) was hydrated from the database into the compiled prompt.
        self::assertStringContainsString('26-year-old', $body['compiled_text']);
    }
}
