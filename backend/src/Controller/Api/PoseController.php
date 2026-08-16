<?php

namespace App\Controller\Api;

use App\Entity\Pose;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PoseController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Pose::class;
    }

    protected function requiredField(): string
    {
        return 'title';
    }

    #[Route('/api/poses', name: 'api_poses_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/poses', name: 'api_poses_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/poses/{id}', name: 'api_poses_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/poses/{id}', name: 'api_poses_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/poses/{id}', name: 'api_poses_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Pose $pose, array $data): void
    {
        $pose
            ->setTitle((string) ($data['title'] ?? ''))
            ->setCategory((string) ($data['category'] ?? 'STANDING'))
            ->setBodyLanguage((string) ($data['body_language'] ?? ''))
            ->setFacialExpression((string) ($data['facial_expression'] ?? 'NEUTRAL'))
            ->setExpressionIntensity((int) ($data['expression_intensity'] ?? 5));

        if (array_key_exists('camera_angle', $data)) {
            $pose->setCameraAngle(isset($data['camera_angle']) ? (string) $data['camera_angle'] : null);
        }
        if (array_key_exists('required_framing', $data)) {
            $pose->setRequiredFraming(isset($data['required_framing']) ? (string) $data['required_framing'] : null);
        }
    }

    protected function toArray(Pose $pose): array
    {
        return [
            'id' => $pose->getId(),
            'title' => $pose->getTitle(),
            'category' => $pose->getCategory(),
            'body_language' => $pose->getBodyLanguage(),
            'facial_expression' => $pose->getFacialExpression(),
            'expression_intensity' => $pose->getExpressionIntensity(),
            'camera_angle' => $pose->getCameraAngle(),
            'required_framing' => $pose->getRequiredFraming(),
            'created_at' => $pose->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $pose->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
