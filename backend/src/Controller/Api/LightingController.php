<?php

namespace App\Controller\Api;

use App\Entity\Lighting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LightingController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Lighting::class;
    }

    protected function requiredField(): string
    {
        return 'setup_type';
    }

    #[Route('/api/lightings', name: 'api_lightings_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/lightings', name: 'api_lightings_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/lightings/{id}', name: 'api_lightings_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/lightings/{id}', name: 'api_lightings_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/lightings/{id}', name: 'api_lightings_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Lighting $lighting, array $data): void
    {
        $lighting
            ->setSetupType((string) ($data['setup_type'] ?? 'NATURAL'))
            ->setColorTemperature((string) ($data['color_temperature'] ?? 'WARM_2700K'));

        if (array_key_exists('key_light_direction', $data)) {
            $lighting->setKeyLightDirection(isset($data['key_light_direction']) ? (string) $data['key_light_direction'] : null);
        }
        if (array_key_exists('hardness', $data)) {
            $lighting->setHardness(isset($data['hardness']) ? (string) $data['hardness'] : null);
        }
        if (isset($data['modifiers'])) {
            $lighting->setModifiers($data['modifiers']);
        }
    }

    protected function toArray(Lighting $lighting): array
    {
        return [
            'id' => $lighting->getId(),
            'setup_type' => $lighting->getSetupType(),
            'color_temperature' => $lighting->getColorTemperature(),
            'key_light_direction' => $lighting->getKeyLightDirection(),
            'hardness' => $lighting->getHardness(),
            'modifiers' => $lighting->getModifiers(),
            'created_at' => $lighting->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $lighting->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
