<?php

namespace App\Controller\Api;

use App\Entity\PromptComposition;
use App\Service\PromptCompiler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class CompileController extends AbstractController
{
    public function __construct(
        private readonly PromptCompiler $promptCompiler,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('/compile', name: 'api_compile', methods: ['POST'])]
    public function compile(Request $request): JsonResponse
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json(['error' => 'No autorizado'], 401);
        }

        $data = json_decode($request->getContent() ?: '{}', true) ?: [];
        $compositionId = $data['composition_id'] ?? null;
        $composition = $data['composition'] ?? null;

        // When no inline composition is provided, resolve a previously saved
        // PromptComposition from the database by id (Phase C).
        if ($composition === null && $compositionId !== null) {
            $persisted = $this->em->getRepository(PromptComposition::class)->find($compositionId);
            $composition = $persisted !== null ? $this->persistedToPayload($persisted) : [];
        }

        // Lenient fallback: if neither an inline composition nor a resolvable id were
        // supplied, treat the whole payload as the composition (pre-existing behaviour).
        if ($composition === null) {
            $composition = $data;
        }

        $result = $this->promptCompiler->compile(
            $composition,
            $compositionId,
            (string) ($data['target_model_hint'] ?? $composition['target_model_hint'] ?? 'FLUX_1_DEV'),
        );

        return $this->json($result, 200);
    }

    /**
     * @return array<string,mixed>
     */
    private function persistedToPayload(PromptComposition $composition): array
    {
        $payload = [];

        $character = $composition->getCharacter();
        if ($character !== null) {
            $payload['character'] = [
                'name' => $character->getName(),
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
            ];
        }

        $outfit = $composition->getOutfit();
        if ($outfit !== null) {
            $payload['outfit'] = [
                'name' => $outfit->getName(),
                'style_category' => $outfit->getStyleCategory(),
                'is_public' => $outfit->getIsPublic(),
            ];
        }

        $pose = $composition->getPose();
        if ($pose !== null) {
            $payload['pose'] = [
                'title' => $pose->getTitle(),
                'category' => $pose->getCategory(),
                'body_language' => $pose->getBodyLanguage(),
                'facial_expression' => $pose->getFacialExpression(),
                'expression_intensity' => $pose->getExpressionIntensity(),
                'camera_angle' => $pose->getCameraAngle(),
                'required_framing' => $pose->getRequiredFraming(),
            ];
        }

        $scene = $composition->getScene();
        if ($scene !== null) {
            $payload['scene'] = [
                'title' => $scene->getTitle(),
                'environment_type' => $scene->getEnvironmentType(),
                'location_details' => $scene->getLocationDetails(),
                'camera_and_lens' => $scene->getCameraAndLens(),
                'weather_and_atmosphere' => $scene->getWeatherAndAtmosphere(),
            ];
        }

        return $payload;
    }
}
