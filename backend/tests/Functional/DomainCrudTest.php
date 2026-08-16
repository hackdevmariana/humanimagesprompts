<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

/**
 * Generic CRUD coverage for the six asset domains. A single data provider
 * drives Create → Read → Update → Delete against /api/{collection}/{id}.
 */
class DomainCrudTest extends DatabaseTestCase
{
    /**
     * @dataProvider provideDomains
     */
    public function testCrudRoundTrip(string $collection, string $labelKey, array $create, string $label, array $update, string $updatedLabel): void
    {
        $client = $this->client;
        $this->login($client);

        // Create
        $client->request('POST', "/api/$collection", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($create));
        $this->assertResponseStatusCodeSame(201);
        $created = json_decode($client->getResponse()->getContent(), true);
        $id = $created['id'];
        $this->assertSame($label, $created[$labelKey]);

        // Read one
        $client->request('GET', "/api/$collection/$id");
        $this->assertResponseStatusCodeSame(200);
        $one = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame($id, $one['id']);
        $this->assertSame($label, $one[$labelKey]);

        // List
        $client->request('GET', "/api/$collection");
        $this->assertResponseStatusCodeSame(200);
        $list = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame(1, $list['count']);
        $this->assertSame($label, $list['data'][0][$labelKey]);

        // Update
        $client->request('PUT', "/api/$collection/$id", [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($update));
        $this->assertResponseStatusCodeSame(200);
        $updated = json_decode($client->getResponse()->getContent(), true);
        $this->assertSame($updatedLabel, $updated[$labelKey]);

        // Delete
        $client->request('DELETE', "/api/$collection/$id");
        $this->assertResponseStatusCodeSame(204);

        // Gone
        $client->request('GET', "/api/$collection/$id");
        $this->assertResponseStatusCodeSame(404);
    }

    public function testCreateWithoutRequiredLabelIsBadRequest(): void
    {
        $client = $this->client;
        $this->login($client);

        $client->request('POST', '/api/characters', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([]));

        $this->assertResponseStatusCodeSame(400);
        $this->assertArrayHasKey('error', json_decode($client->getResponse()->getContent(), true));
    }

    public function testCrudEndpointsRequireAuthentication(): void
    {
        $client = $this->client;

        $client->request('GET', '/api/characters');
        $this->assertResponseStatusCodeSame(401);

        $client->request('POST', '/api/characters', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['name' => 'X']));
        $this->assertResponseStatusCodeSame(401);

        $client->request('PUT', '/api/characters/00000000-0000-0000-0000-000000000000', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['name' => 'X']));
        $this->assertResponseStatusCodeSame(401);

        $client->request('DELETE', '/api/characters/00000000-0000-0000-0000-000000000000');
        $this->assertResponseStatusCodeSame(401);
    }

    public static function provideDomains(): array
    {
        return [
            'character' => [
                'characters', 'name',
                ['name' => 'Luna', 'age' => 28, 'gender' => 'FEMALE', 'ethnicity' => 'CAUCASIAN'], 'Luna',
                ['name' => 'Luna Edit', 'age' => 30], 'Luna Edit',
            ],
            'pose' => [
                'poses', 'title',
                ['title' => 'Portrait Pose', 'category' => 'PORTRAIT', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5], 'Portrait Pose',
                ['title' => 'Action Pose', 'expression_intensity' => 8], 'Action Pose',
            ],
            'outfit' => [
                'outfits', 'name',
                ['name' => 'Casual Wear', 'style_category' => 'CASUAL', 'is_public' => true], 'Casual Wear',
                ['name' => 'Formal Wear', 'style_category' => 'FORMAL'], 'Formal Wear',
            ],
            'scene' => [
                'scenes', 'title',
                ['title' => 'Bright Studio', 'environment_type' => 'INDOOR', 'location_details' => 'by window'], 'Bright Studio',
                ['title' => 'Dusk Exterior', 'location_details' => 'roof'], 'Dusk Exterior',
            ],
            'lighting' => [
                'lightings', 'setup_type',
                ['setup_type' => 'GOLDEN_HOUR', 'color_temperature' => 'WARM_2700K'], 'GOLDEN_HOUR',
                ['setup_type' => 'STUDIO_SOFTBOX', 'color_temperature' => 'COOL_5600K'], 'STUDIO_SOFTBOX',
            ],
            'time-weather' => [
                'time-weather', 'season',
                ['season' => 'SUMMER', 'time_of_day' => 'GOLDEN_HOUR', 'weather' => 'CLEAR'], 'SUMMER',
                ['season' => 'WINTER', 'time_of_day' => 'NIGHT'], 'WINTER',
            ],
        ];
    }
}
