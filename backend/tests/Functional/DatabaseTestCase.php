<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Base for functional tests that need a real HTTP client AND an isolated
 * in-memory SQLite database with the schema built straight from the mappings.
 *
 * Each test gets a fresh connection (tearDown shuts the kernel), so the
 * in-memory database is empty and rebuilt in setUp — no cross-test leakage.
 */
abstract class DatabaseTestCase extends WebTestCase
{
    protected EntityManagerInterface $em;
    protected SchemaTool $schemaTool;
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        // createClient() boots the kernel exactly once per test and exposes the test client.
        $this->client = static::createClient();

        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
        $this->schemaTool = new SchemaTool($this->em);

        $classes = $this->em->getMetadataFactory()->getAllMetadata();
        $this->schemaTool->dropSchema($classes);
        $this->schemaTool->createSchema($classes);
    }

    protected function login(KernelBrowser $client): void
    {
        $client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => 'admin@example.com', 'password' => 'password'])
        );

        $this->assertResponseStatusCodeSame(200);
    }
}
