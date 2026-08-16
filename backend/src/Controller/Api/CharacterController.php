<?php

namespace App\Controller\Api;

use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CharacterController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return Character::class;
    }

    protected function requiredField(): string
    {
        return 'name';
    }

    #[Route('/api/characters', name: 'api_characters_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/characters', name: 'api_characters_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/characters/{id}', name: 'api_characters_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/characters/{id}', name: 'api_characters_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/characters/{id}', name: 'api_characters_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(Character $character, array $data): void
    {
        $character
            ->setName((string) ($data['name'] ?? ''))
            ->setAge((int) ($data['age'] ?? 0))
            ->setGender((string) ($data['gender'] ?? 'NON_BINARY'))
            ->setEthnicity((string) ($data['ethnicity'] ?? 'MULTIRACIAL'));

        if (array_key_exists('is_public', $data)) {
            $character->setIsPublic((bool) $data['is_public']);
        }
        if (isset($data['cranial_morphology'])) {
            $character->setCranialMorphology($data['cranial_morphology']);
        }
        if (isset($data['skin_profile'])) {
            $character->setSkinProfile($data['skin_profile']);
        }
        if (isset($data['hair_profile'])) {
            $character->setHairProfile($data['hair_profile']);
        }
        if (isset($data['eye_profile'])) {
            $character->setEyeProfile($data['eye_profile']);
        }
        if (isset($data['facial_features'])) {
            $character->setFacialFeatures($data['facial_features']);
        }
        if (isset($data['current_grooming'])) {
            $character->setCurrentGrooming($data['current_grooming']);
        }
        if (isset($data['current_makeup'])) {
            $character->setCurrentMakeup($data['current_makeup']);
        }
    }

    protected function toArray(Character $character): array
    {
        return [
            'id' => $character->getId(),
            'name' => $character->getName(),
            'is_public' => $character->isPublic(),
            'gender' => $character->getGender(),
            'age' => $character->getAge(),
            'ethnicity' => $character->getEthnicity(),
            'cranial_morphology' => $character->getCranialMorphology(),
            'skin_profile' => $character->getSkinProfile(),
            'hair_profile' => $character->getHairProfile(),
            'eye_profile' => $character->getEyeProfile(),
            'facial_features' => $character->getFacialFeatures(),
            'current_grooming' => $character->getCurrentGrooming(),
            'current_makeup' => $character->getCurrentMakeup(),
            'created_at' => $character->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $character->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}
