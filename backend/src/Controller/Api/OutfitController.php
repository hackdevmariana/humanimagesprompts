<?php

namespace App\Controller\Api;

use App\Entity\Outfit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class OutfitController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Outfit::class;
    }

    protected function requiredField(): string
    {
        return 'name';
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
    }

    protected function toArray(Outfit $outfit): array
    {
        return [
            'id' => $outfit->getId(),
            'name' => $outfit->getName(),
            'style_category' => $outfit->getStyleCategory(),
            'is_public' => $outfit->isPublic(),
            'garment_count' => count($outfit->getGarments()),
            'created_at' => $outfit->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $outfit->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
