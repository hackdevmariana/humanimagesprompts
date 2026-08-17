<?php

namespace App\Controller\Api;

use App\Entity\Garment;
use App\Entity\GarmentSlot;
use App\Entity\Outfit;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class OutfitController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(
        private EntityManagerInterface $em,
        private LoggerInterface $logger
    ) {}

    protected function entityClass(): string
    {
        return Outfit::class;
    }

    protected function requiredField(): string
    {
        return 'name';
    }

    /**
     * Canonical tag namespaces and allowed values for validation.
     */
    private const TAG_TAXONOMY = [
        'gender' => ['female', 'male', 'unisex'],
        'season' => ['spring', 'summer', 'autumn', 'winter'],
        'weather' => ['hot', 'warm', 'mild', 'cool', 'cold', 'rain', 'snow', 'wind'],
        'occasion' => ['casual', 'formal', 'business', 'street', 'sport', 'elegant', 'beach', 'evening', 'period'],
        'environment' => ['urban', 'nature', 'studio', 'indoor', 'outdoor'],
    ];

    /**
     * Validates tags against canonical taxonomy. Logs warning for non-canonical tags.
     * Does not block creation (soft validation).
     */
    private function validateTags(array $tags): void
    {
        foreach ($tags as $tag) {
            if (!is_string($tag) || !str_contains($tag, ':')) {
                $this->logger->warning('Garment tag malformed (expected namespace:value)', ['tag' => $tag]);
                continue;
            }
            [$namespace, $value] = explode(':', $tag, 2);
            if (!isset(self::TAG_TAXONOMY[$namespace])) {
                $this->logger->warning('Garment tag namespace not recognized', ['namespace' => $namespace, 'tag' => $tag]);
                continue;
            }
            if (!in_array($value, self::TAG_TAXONOMY[$namespace], true)) {
                $this->logger->warning('Garment tag value not in canonical list', ['tag' => $tag, 'allowed' => self::TAG_TAXONOMY[$namespace]]);
            }
        }
    }

    #[Route('/api/outfits', name: 'api_outfits_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/outfits', name: 'api_outfits_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/outfits/{id}', name: 'api_outfits_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/outfits/{id}', name: 'api_outfits_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/outfits/{id}', name: 'api_outfits_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Outfit $outfit, array $data): void
    {
        $outfit
            ->setName((string) ($data['name'] ?? ''))
            ->setStyleCategory((string) ($data['style_category'] ?? 'CASUAL'));

        if (array_key_exists('is_public', $data)) {
            $outfit->setIsPublic((bool) $data['is_public']);
        }

        // Process garments array
        if (array_key_exists('garments', $data) && is_array($data['garments'])) {
            // Clear existing garments (orphanRemoval will handle deletion)
            foreach ($outfit->getGarments() as $existingSlot) {
                $outfit->removeGarment($existingSlot);
            }

            foreach ($data['garments'] as $garmentData) {
                $slotType = $garmentData['slot_type'] ?? null;
                if (!$slotType) {
                    continue;
                }

                $garment = null;
                if (isset($garmentData['garment_id']) && $garmentData['garment_id']) {
                    // Reference existing garment
                    $garment = $this->em->getRepository(Garment::class)->find($garmentData['garment_id']);
                } elseif (isset($garmentData['garment']) && is_array($garmentData['garment'])) {
                    // Create new garment inline
                    $garment = new Garment();
                    $this->fillGarment($garment, $garmentData['garment']);
                    $this->em->persist($garment);
                }

                if ($garment) {
                    $slot = new GarmentSlot();
                    $slot->setSlotType($slotType);
                    $slot->setGarment($garment);
                    $outfit->addGarment($slot);
                }
            }
        }
    }

    private function fillGarment(Garment $garment, array $data): void
    {
        $garment
            ->setName((string) ($data['name'] ?? ''))
            ->setCategory((string) ($data['category'] ?? 'TOP'))
            ->setSubCategory((string) ($data['sub_category'] ?? ''))
            ->setFit((string) ($data['fit'] ?? 'REGULAR'));

        if (array_key_exists('fabric', $data)) {
            $garment->setFabric(is_array($data['fabric']) ? $data['fabric'] : []);
        }
        if (array_key_exists('primary_color', $data)) {
            $garment->setPrimaryColor(is_array($data['primary_color']) ? $data['primary_color'] : []);
        }
        if (array_key_exists('secondary_color', $data)) {
            $garment->setSecondaryColor($data['secondary_color'] ? (is_array($data['secondary_color']) ? $data['secondary_color'] : []) : null);
        }
        if (array_key_exists('pattern', $data)) {
            $garment->setPattern($data['pattern'] ?? null);
        }
        if (array_key_exists('tags', $data)) {
            $tags = is_array($data['tags']) ? $data['tags'] : [];
            $this->validateTags($tags);
            $garment->setTags($tags);
        }
        if (array_key_exists('label', $data)) {
            $garment->setLabel($data['label'] ?? null);
        }
    }

    protected function toArray(Outfit $outfit): array
    {
        $garments = [];
        foreach ($outfit->getGarments() as $slot) {
            $garment = $slot->getGarment();
            if ($garment) {
                $garments[] = [
                    'slot_type' => $slot->getSlotType(),
                    'garment' => [
                        'id' => $garment->getId(),
                        'name' => $garment->getName(),
                        'category' => $garment->getCategory(),
                        'sub_category' => $garment->getSubCategory(),
                        'fit' => $garment->getFit(),
                        'fabric' => $garment->getFabric(),
                        'primary_color' => $garment->getPrimaryColor(),
                        'secondary_color' => $garment->getSecondaryColor(),
                        'pattern' => $garment->getPattern(),
                        'tags' => $garment->getTags(),
                        'label' => $garment->getLabel(),
                        'created_at' => $garment->getCreatedAt()?->format(\DateTimeInterface::ATOM),
                        'updated_at' => $garment->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
                    ],
                ];
            }
        }

        return [
            'id' => $outfit->getId(),
            'name' => $outfit->getName(),
            'style_category' => $outfit->getStyleCategory(),
            'is_public' => $outfit->isPublic(),
            'garments' => $garments,
            'garment_count' => count($outfit->getGarments()),
            'created_at' => $outfit->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $outfit->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}