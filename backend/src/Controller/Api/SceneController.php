<?php

namespace App\Controller\Api;

use App\Entity\Scene;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SceneController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Scene::class;
    }

    protected function requiredField(): string
    {
        return 'title';
    }

    #[Route('/api/scenes', name: 'api_scenes_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/scenes', name: 'api_scenes_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/scenes/{id}', name: 'api_scenes_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/scenes/{id}', name: 'api_scenes_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/scenes/{id}', name: 'api_scenes_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Scene $scene, array $data): void
    {
        $scene
            ->setTitle((string) ($data['title'] ?? ''))
            ->setEnvironmentType((string) ($data['environment_type'] ?? 'URBAN'))
            ->setLocationDetails((string) ($data['location_details'] ?? ''));

        if (isset($data['camera_and_lens'])) {
            $scene->setCameraAndLens($data['camera_and_lens']);
        }
        if (isset($data['weather_and_atmosphere'])) {
            $scene->setWeatherAndAtmosphere($data['weather_and_atmosphere']);
        }
    }

    protected function toArray(Scene $scene): array
    {
        return [
            'id' => $scene->getId(),
            'title' => $scene->getTitle(),
            'environment_type' => $scene->getEnvironmentType(),
            'location_details' => $scene->getLocationDetails(),
            'camera_and_lens' => $scene->getCameraAndLens(),
            'weather_and_atmosphere' => $scene->getWeatherAndAtmosphere(),
            'created_at' => $scene->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $scene->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
