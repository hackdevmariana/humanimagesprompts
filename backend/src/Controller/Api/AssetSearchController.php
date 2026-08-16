<?php

namespace App\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * GET /api/assets/search?q=<term>
 *
 * Fuzzy-matches asset names/titles across the five asset domains and returns
 * ready-to-pre-fill selections, satisfying the asset-library autocomplete spec.
 */
#[Route('/api/assets/search', name: 'api_assets_search')]
class AssetSearchController extends AbstractController
{
    /** @var array<string,string> entity FQN => DQL label property */
    private const SEARCHABLE = [
        'App\Entity\Character' => 'name',
        'App\Entity\Outfit' => 'name',
        'App\Entity\Pose' => 'title',
        'App\Entity\Scene' => 'title',
        'App\Entity\Lighting' => 'setupType',
    ];

    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->json(['error' => 'No autorizado'], 401);
        }

        $q = (string) $request->query->get('q', '');
        $results = [];

        foreach (self::SEARCHABLE as $entity => $property) {
            $qb = $this->em->getRepository($entity)->createQueryBuilder('e')
                ->where("e.$property LIKE :q")
                ->setParameter('q', '%' . $q . '%')
                ->setMaxResults(10);

            foreach ($qb->getQuery()->getResult() as $entity) {
                $results[] = [
                    'type' => strtolower((new \ReflectionClass($entity))->getShortName()),
                    'id' => $entity->getId(),
                    'label' => $entity->{'get' . ucfirst($property)}(),
                ];
            }
        }

        return $this->json(['query' => $q, 'results' => $results, 'count' => count($results)]);
    }
}
