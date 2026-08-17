<?php

namespace App\DataFixtures;

use App\Entity\Garment;
use App\Entity\GarmentSlot;
use App\Entity\Outfit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GarmentCatalogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $catalogFiles = [
            'tops.php',
            'bottoms.php',
            'outerwear.php',
            'dresses.php',
            'footwear.php',
            'headwear.php',
            'accessories.php',
            'lingerie.php',
            'swimwear.php',
        ];

        $catalogDir = __DIR__ . '/../../fixtures/catalog/';

        $createdGarments = [];

        foreach ($catalogFiles as $file) {
            $catalog = include $catalogDir . $file;
            foreach ($catalog as $item) {
                $base = $item['base'];
                $colors = $item['colors'] ?? [['color_name' => $base['primary_color']['color_name'] ?? 'Default', 'hex_code' => $base['primary_color']['hex_code'] ?? '#FFFFFF']];
                $fabrics = $item['fabrics'] ?? [$base['fabric']];

                foreach ($colors as $color) {
                    foreach ($fabrics as $fabric) {
                        $garment = new Garment();
                        $garment
                            ->setName($base['name'])
                            ->setCategory($base['category'])
                            ->setSubCategory($base['sub_category'])
                            ->setFit($base['fit'])
                            ->setFabric($fabric)
                            ->setPrimaryColor($color)
                            ->setSecondaryColor($base['secondary_color'] ?? null)
                            ->setPattern($base['pattern'] ?? 'SOLID')
                            ->setTags($base['tags'] ?? [])
                            ->setLabel($base['label'] ?? null);

                        $manager->persist($garment);
                        $createdGarments[] = $garment;
                    }
                }
            }
        }

        $manager->flush();

        // Create example outfits combining catalog garments
        $this->createExampleOutfits($manager, $createdGarments);
        $manager->flush();
    }

    private function createExampleOutfits(ObjectManager $manager, array $garments): void
    {
        // Group garments by category for easy selection
        $byCategory = [];
        foreach ($garments as $g) {
            $byCategory[$g->getCategory()][] = $g;
        }

        $outfitTemplates = [
            // Casual summer outfit (female)
            [
                'name' => 'Summer Casual Look',
                'style_category' => 'CASUAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'season:summer']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'season:summer']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['gender:female', 'season:summer']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:female', 'season:summer']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['gender:female', 'season:summer']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:female', 'season:summer']],
                ],
            ],
            // Business formal (male)
            [
                'name' => 'Business Formal Suit',
                'style_category' => 'FORMAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['gender:male', 'occasion:business']],
                    'MID_LAYER' => ['category' => 'TOP', 'tags' => ['gender:male', 'occasion:business']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['gender:male', 'occasion:business']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:male', 'occasion:formal']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:male', 'occasion:business']],
                ],
            ],
            // Winter warm (unisex)
            [
                'name' => 'Winter Warm Layers',
                'style_category' => 'CASUAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['season:winter', 'weather:cold']],
                    'MID_LAYER' => ['category' => 'TOP', 'tags' => ['season:winter', 'weather:cold']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['season:winter', 'weather:cold']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['season:winter', 'weather:cold']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['season:winter', 'weather:cold']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['season:winter', 'weather:cold']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['season:winter', 'weather:cold']],
                ],
            ],
            // Streetwear (unisex)
            [
                'name' => 'Urban Street Style',
                'style_category' => 'STREET',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['occasion:street', 'gender:unisex']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['occasion:street', 'gender:unisex']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['occasion:street', 'gender:unisex']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['occasion:street', 'gender:unisex']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['occasion:street', 'gender:unisex']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['occasion:street', 'gender:unisex']],
                ],
            ],
            // Beach outfit (female)
            [
                'name' => 'Beach Day Essentials',
                'style_category' => 'CASUAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'FULL_BODY', 'tags' => ['gender:female', 'occasion:beach']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:female', 'occasion:beach']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['gender:female', 'occasion:beach']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:female', 'occasion:beach']],
                ],
            ],
            // Evening elegant (female)
            [
                'name' => 'Evening Elegance',
                'style_category' => 'FORMAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'FULL_BODY', 'tags' => ['gender:female', 'occasion:evening']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'occasion:evening']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:female', 'occasion:evening']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:female', 'occasion:evening']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['gender:female', 'occasion:evening']],
                ],
            ],
            // Sport/Active (unisex)
            [
                'name' => 'Active Sport Wear',
                'style_category' => 'ATHLETIC',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['occasion:sport', 'gender:unisex']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['occasion:sport', 'gender:unisex']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['occasion:sport', 'gender:unisex']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['occasion:sport', 'gender:unisex']],
                ],
            ],
            // Autumn layers (male)
            [
                'name' => 'Autumn Layers Look',
                'style_category' => 'CASUAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['gender:male', 'season:autumn']],
                    'MID_LAYER' => ['category' => 'TOP', 'tags' => ['gender:male', 'season:autumn']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['gender:male', 'season:autumn']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['gender:male', 'season:autumn']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:male', 'season:autumn']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:male', 'season:autumn']],
                ],
            ],
            // Spring fresh (female)
            [
                'name' => 'Spring Fresh Outfit',
                'style_category' => 'CASUAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'season:spring']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'season:spring']],
                    'BOTTOM' => ['category' => 'BOTTOM', 'tags' => ['gender:female', 'season:spring']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:female', 'season:spring']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['gender:female', 'season:spring']],
                ],
            ],
            // Cocktail party (female)
            [
                'name' => 'Cocktail Party Dress',
                'style_category' => 'FORMAL',
                'is_public' => true,
                'slots' => [
                    'BASE_LAYER' => ['category' => 'FULL_BODY', 'tags' => ['gender:female', 'occasion:evening']],
                    'OUTER_LAYER' => ['category' => 'TOP', 'tags' => ['gender:female', 'occasion:evening']],
                    'FOOTWEAR' => ['category' => 'FOOTWEAR', 'tags' => ['gender:female', 'occasion:evening']],
                    'ACCESSORIES' => ['category' => 'ACCESSORY', 'tags' => ['gender:female', 'occasion:evening']],
                    'HEADWEAR' => ['category' => 'HEADWEAR', 'tags' => ['gender:female', 'occasion:evening']],
                ],
            ],
        ];

        foreach ($outfitTemplates as $template) {
            $outfit = new Outfit();
            $outfit
                ->setName($template['name'])
                ->setStyleCategory($template['style_category'])
                ->setIsPublic($template['is_public']);

            foreach ($template['slots'] as $slotType => $criteria) {
                $candidates = $this->filterGarments($garments, $criteria);
                if (!empty($candidates)) {
                    $garment = $candidates[array_rand($candidates)];
                    $slot = new GarmentSlot();
                    $slot->setSlotType($slotType);
                    $slot->setGarment($garment);
                    $outfit->addGarment($slot);
                }
            }

            $manager->persist($outfit);
        }
    }

    /**
     * Filter garments by category and tags (AND logic)
     */
    private function filterGarments(array $garments, array $criteria): array
    {
        $category = $criteria['category'] ?? null;
        $requiredTags = $criteria['tags'] ?? [];

        return array_filter($garments, function ($g) use ($category, $requiredTags) {
            if ($category && $g->getCategory() !== $category) {
                return false;
            }
            $garmentTags = $g->getTags();
            foreach ($requiredTags as $requiredTag) {
                if (!in_array($requiredTag, $garmentTags, true)) {
                    return false;
                }
            }
            return true;
        });
    }
}