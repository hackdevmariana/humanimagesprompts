<?php

namespace App\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    private const VALID_BODY = '{"email":"admin@example.com","password":"password"}';

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testLoginSuccess(): void
    {
        $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], self::VALID_BODY);

        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $response = json_decode($this->client->getResponse()->getContent(), true);

        self::assertArrayHasKey('logged_in', $response);
        self::assertTrue($response['logged_in']);
        self::assertArrayHasKey('user', $response);
        self::assertSame('admin@example.com', $response['user']['email']);
    }

    public function testLoginWithWrongPassword(): void
    {
        $this->client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => 'admin@example.com', 'password' => 'wrongpassword'])
        );

        $this->assertResponseStatusCodeSame(401);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        self::assertArrayHasKey('error', $response);
    }

    public function testLoginWithNonExistentUser(): void
    {
        $this->client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['email' => 'nonexistent@example.com', 'password' => 'password'])
        );

        $this->assertResponseStatusCodeSame(401);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        self::assertArrayHasKey('error', $response);
    }

    public function testLoginWithMissingFieldsReturnsUnauthorized(): void
    {
        $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([]));

        $this->assertResponseStatusCodeSame(401);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        self::assertArrayHasKey('error', $response);
    }

    public function testInvalidJsonBodyReturnsUnauthorized(): void
    {
        $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], 'invalid json');

        $this->assertResponseStatusCodeSame(401);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        self::assertArrayHasKey('error', $response);
    }

    public function testMeEndpointRequiresAuthentication(): void
    {
        $this->client->request('GET', '/api/me');
        $this->assertResponseStatusCodeSame(401);
    }

    public function testMeEndpointWithValidSession(): void
    {
        $this->client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], self::VALID_BODY);
        $this->assertResponseStatusCodeSame(200);

        $this->client->request('GET', '/api/me');
        $this->assertResponseStatusCodeSame(200);

        $response = json_decode($this->client->getResponse()->getContent(), true);
        self::assertArrayHasKey('authenticated', $response);
        self::assertTrue($response['authenticated']);
        self::assertSame('admin@example.com', $response['user']['email']);
    }

    public function testOptionsPreflightLogin(): void
    {
        $this->client->request('OPTIONS', '/api/login');
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('Access-Control-Allow-Origin', 'http://localhost:3000');
        $this->assertResponseHeaderSame('Access-Control-Allow-Credentials', 'true');
        $this->assertResponseHeaderSame('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        $this->assertResponseHeaderSame('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    }

    public function testOptionsPreflightMe(): void
    {
        $this->client->request('OPTIONS', '/api/me');
        $this->assertResponseStatusCodeSame(200);
        $this->assertResponseHeaderSame('Access-Control-Allow-Origin', 'http://localhost:3000');
        $this->assertResponseHeaderSame('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    }
}
