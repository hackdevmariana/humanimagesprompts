<?php

namespace App\Tests\Functional;

class AssetSearchTest extends DatabaseTestCase
{
    public function testSearchReturnsMatchingAssetsAcrossDomains(): void
    {
        $client = $this->client;
        $this->login($client);

        $client->request('POST', '/api/characters', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['name' => 'Elena', 'age' => 26, 'gender' => 'FEMALE', 'ethnicity' => 'CAUCASIAN']));
        $this->assertResponseStatusCodeSame(201);

        $client->request('POST', '/api/outfits', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['name' => 'Denim Jacket', 'style_category' => 'CASUAL']));
        $this->assertResponseStatusCodeSame(201);

        $client->request('POST', '/api/poses', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['title' => 'Standing Pose', 'category' => 'PORTRAIT', 'body_language' => 'Standing', 'facial_expression' => 'NEUTRAL', 'expression_intensity' => 5]));
        $this->assertResponseStatusCodeSame(201);

        // Match on a character name (lowercase query, case-insensitive match).
        $client->request('GET', '/api/assets/search?q=elena');
        $this->assertResponseStatusCodeSame(200);
        $hit = $this->findResult(json_decode($client->getResponse()->getContent(), true)['results'], 'character', 'Elena');
        $this->assertNotNull($hit);
        $this->assertNotEmpty($hit['id']);

        // Match on an outfit name.
        $client->request('GET', '/api/assets/search?q=denim');
        $this->assertResponseStatusCodeSame(200);
        $outfitHit = $this->findResult(json_decode($client->getResponse()->getContent(), true)['results'], 'outfit', 'Denim Jacket');
        $this->assertNotNull($outfitHit);

        // Match on a pose title (different domain, same query term).
        $client->request('GET', '/api/assets/search?q=pOSE');
        $this->assertResponseStatusCodeSame(200);
        $poseHit = $this->findResult(json_decode($client->getResponse()->getContent(), true)['results'], 'pose', 'Standing Pose');
        $this->assertNotNull($poseHit);
    }

    public function testSearchWithEmptyQueryReturnsAllAssets(): void
    {
        $client = $this->client;
        $this->login($client);

        $client->request('POST', '/api/characters', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode(['name' => 'Elena', 'age' => 26, 'gender' => 'FEMALE', 'ethnicity' => 'CAUCASIAN']));
        $this->assertResponseStatusCodeSame(201);

        $client->request('GET', '/api/assets/search?q=');
        $this->assertResponseStatusCodeSame(200);

        $body = json_decode($client->getResponse()->getContent(), true);
        $this->assertGreaterThanOrEqual(1, $body['count']);
    }

    public function testSearchRequiresAuthentication(): void
    {
        $this->client->request('GET', '/api/assets/search?q=x');
        $this->assertResponseStatusCodeSame(401);
    }

    private function findResult(array $results, string $type, string $label): ?array
    {
        foreach ($results as $result) {
            if ($result['type'] === $type && $result['label'] === $label) {
                return $result;
            }
        }

        return null;
    }
}
