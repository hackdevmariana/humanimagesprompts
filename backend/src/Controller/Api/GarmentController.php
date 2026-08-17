<?php

namespace App\Controller\Api;

use App\Entity\Garment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class GarmentController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Garment::class;
    }

    protected function requiredField(): string
    {
        return 'name';
    }

    #[Route('/api/garments', name: 'api_garments_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/garments', name: 'api_garments_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/garments/{id}', name: 'api_garments_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/garments/{id}', name: 'api_garments_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/garments/{id}', name: 'api_garments_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Garment $garment, array $data): void
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
            $garment->setTags(is_array($data['tags']) ? $data['tags'] : []);
        }
        if (array_key_exists('label', $data)) {
            $garment->setLabel($data['label'] ?? null);
        }
    }

    protected function toArray(Garment $garment): array
    {
        return [
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
        ];
    }
}