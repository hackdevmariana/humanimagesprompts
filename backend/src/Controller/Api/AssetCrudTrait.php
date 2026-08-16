<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Shared CRUD verbs for the five asset domains (Character, Pose, Outfit, Scene, Lighting).
 *
 * Concrete controllers declare: entityClass(), requiredField(), toArray() and fill(),
 * then expose the five routes that delegate here. Auth is enforced once per request.
 */
trait AssetCrudTrait
{
    abstract protected function entityClass(): string;

    abstract protected function requiredField(): string;

    /**
     * Concrete controllers implement toArray($entity) and fill($entity, $data) type-hinting
     * their own entity class. They are invoked dynamically from the CRUD verbs below, so they
     * are intentionally NOT declared abstract here (PHP forbids narrowing an abstract param).
     */

    protected function requireAuth(): ?JsonResponse
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json(['error' => 'No autorizado'], 401);
        }

        return null;
    }

    protected function decode(Request $request): array
    {
        return json_decode($request->getContent() ?: '{}', true) ?: [];
    }

    protected function listEntities(): JsonResponse
    {
        if ($response = $this->requireAuth()) {
            return $response;
        }

        $items = array_map(
            fn ($entity) => $this->toArray($entity),
            $this->em->getRepository($this->entityClass())->findAll()
        );

        return $this->json(['data' => $items, 'count' => count($items)]);
    }

    protected function getEntity(string $id): JsonResponse
    {
        if ($response = $this->requireAuth()) {
            return $response;
        }

        $entity = $this->em->getRepository($this->entityClass())->find($id);

        return $entity === null
            ? $this->json(['error' => 'No encontrado'], 404)
            : $this->json($this->toArray($entity));
    }

    protected function createEntity(Request $request): JsonResponse
    {
        if ($response = $this->requireAuth()) {
            return $response;
        }

        $data = $this->decode($request);
        if (empty($data[$this->requiredField()])) {
            return $this->json(['error' => sprintf('El campo "%s" es obligatorio', $this->requiredField())], 400);
        }

        $class = $this->entityClass();
        $entity = new $class();
        $this->fill($entity, $data);
        $this->em->persist($entity);
        $this->em->flush();

        return $this->json($this->toArray($entity), 201);
    }

    protected function updateEntity(string $id, Request $request): JsonResponse
    {
        if ($response = $this->requireAuth()) {
            return $response;
        }

        $entity = $this->em->getRepository($this->entityClass())->find($id);
        if ($entity === null) {
            return $this->json(['error' => 'No encontrado'], 404);
        }

        $this->fill($entity, $this->decode($request));
        $this->em->flush();

        return $this->json($this->toArray($entity));
    }

    protected function deleteEntity(string $id): JsonResponse
    {
        if ($response = $this->requireAuth()) {
            return $response;
        }

        $entity = $this->em->getRepository($this->entityClass())->find($id);
        if ($entity === null) {
            return $this->json(['error' => 'No encontrado'], 404);
        }

        $this->em->remove($entity);
        $this->em->flush();

        return $this->json(null, 204);
    }
}
