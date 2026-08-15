<?php

namespace App\Controller\Api;

use App\Service\PromptCompiler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class CompileController extends AbstractController
{
    public function __construct(private readonly PromptCompiler $promptCompiler)
    {
    }

    #[Route('/compile', name: 'api_compile', methods: ['POST'])]
    public function compile(Request $request): JsonResponse
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json(['error' => 'No autorizado'], 401);
        }

        $data = json_decode($request->getContent() ?: '{}', true) ?: [];
        $composition = $data['composition'] ?? $data;

        $result = $this->promptCompiler->compile(
            $composition,
            $data['composition_id'] ?? null,
            (string) ($data['target_model_hint'] ?? $composition['target_model_hint'] ?? 'FLUX_1_DEV'),
        );

        return $this->json($result, 200);
    }
}
