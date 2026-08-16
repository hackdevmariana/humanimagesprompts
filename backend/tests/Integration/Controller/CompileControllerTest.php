<?php

namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompileControllerTest extends WebTestCase
{
    private const UUID_V4 = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    private function login(KernelBrowser $client): void
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

    private function compile(KernelBrowser $client, string $body): array
    {
        $client->request('POST', '/api/compile', [], [], ['CONTENT_TYPE' => 'application/json'], $body);

        return [
            'status' => $client->getResponse()->getStatusCode(),
            'body' => json_decode($client->getResponse()->getContent(), true),
        ];
    }

    public function testUnauthenticatedCompileIsDenied(): void
    {
        $client = static::createClient();
        $result = $this->compile($client, json_encode(['composition' => ['character' => ['name' => 'Luna']]]));

        self::assertNotSame(200, $result['status']);
        self::assertContains($result['status'], [401, 403]);
    }

    public function testAuthenticatedCompileWithoutCompositionIdGeneratesUuid(): void
    {
        $client = static::createClient();
        $this->login($client);

        $result = $this->compile(
            $client,
            json_encode(['composition' => ['character' => ['name' => 'Luna', 'age' => 28, 'gender' => 'FEMALE', 'ethnicity' => 'CAUCASIAN']]])
        );

        self::assertSame(200, $result['status']);
        self::assertArrayHasKey('meta', $result['body']);
        self::assertArrayHasKey('canonical', $result['body']);
        self::assertArrayHasKey('compiled_text', $result['body']);
        self::assertNotEmpty($result['body']['compiled_text']);
        self::assertSame('FLUX_1_DEV', $result['body']['meta']['target_model_hint']);
        // Regression (toRfc4122 — NOT toRfc4122String): a valid UUID v4 is generated.
        self::assertMatchesRegularExpression(self::UUID_V4, $result['body']['meta']['composition_id']);
    }

    public function testAuthenticatedCompileEchoesProvidedCompositionId(): void
    {
        $client = static::createClient();
        $this->login($client);

        $id = '01234567-89ab-4cde-9abc-def012345678';
        $result = $this->compile(
            $client,
            json_encode(['composition_id' => $id, 'composition' => ['character' => ['name' => 'Luna']]])
        );

        self::assertSame(200, $result['status']);
        self::assertSame($id, $result['body']['meta']['composition_id']);
    }

    public function testTargetModelHintIsReflectedInMeta(): void
    {
        $client = static::createClient();
        $this->login($client);

        foreach (['FLUX_1_DEV', 'MIDJOURNEY', 'SDXL'] as $hint) {
            $result = $this->compile(
                $client,
                json_encode(['target_model_hint' => $hint, 'composition' => ['character' => ['name' => 'Luna']]])
            );

            self::assertSame(200, $result['status']);
            self::assertSame($hint, $result['body']['meta']['target_model_hint']);
            self::assertNotEmpty($result['body']['compiled_text']);
        }
    }

    public function testInvalidJsonBodyIsAcceptedAsEmptyComposition(): void
    {
        $client = static::createClient();
        $this->login($client);

        $result = $this->compile($client, 'not-json');

        self::assertSame(200, $result['status']);
        self::assertMatchesRegularExpression(self::UUID_V4, $result['body']['meta']['composition_id']);
    }

    public function testAuthenticatedCompileIncludesTimeBlock(): void
    {
        $client = static::createClient();
        $this->login($client);

        $result = $this->compile(
            $client,
            json_encode(['composition' => ['time' => ['season' => 'WINTER', 'time_of_day' => 'NIGHT', 'weather' => 'SNOWY']]])
        );

        self::assertSame(200, $result['status']);
        self::assertArrayHasKey('time', $result['body']['canonical']);
        self::assertStringContainsString('Time: winter, night, snowy day.', $result['body']['compiled_text']);
    }

    public function testOptionsPreflightCompile(): void
    {
        $client = static::createClient();
        $client->request('OPTIONS', '/api/compile');

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('Access-Control-Allow-Origin', 'http://localhost:3000');
        $this->assertResponseHeaderSame('Access-Control-Allow-Credentials', 'true');
        $this->assertResponseHeaderSame('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        $this->assertResponseHeaderSame('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    }
}
