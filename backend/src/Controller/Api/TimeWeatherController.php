<?php

namespace App\Controller\Api;

use App\Entity\TimeWeather;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TimeWeatherController extends AbstractController
{
    use AssetCrudTrait;

    public function __construct(private EntityManagerInterface $em) {}

    protected function entityClass(): string
    {
        return TimeWeather::class;
    }

    protected function requiredField(): string
    {
        return 'season';
    }

    #[Route('/api/time-weather', name: 'api_time_weather_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->listEntities();
    }

    #[Route('/api/time-weather', name: 'api_time_weather_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->createEntity($request);
    }

    #[Route('/api/time-weather/{id}', name: 'api_time_weather_show', methods: ['GET'])]
    public function show(string $id): JsonResponse
    {
        return $this->getEntity($id);
    }

    #[Route('/api/time-weather/{id}', name: 'api_time_weather_update', methods: ['PUT'])]
    public function update(string $id, Request $request): JsonResponse
    {
        return $this->updateEntity($id, $request);
    }

    #[Route('/api/time-weather/{id}', name: 'api_time_weather_delete', methods: ['DELETE'])]
    public function delete(string $id): JsonResponse
    {
        return $this->deleteEntity($id);
    }

    protected function fill(TimeWeather $timeWeather, array $data): void
    {
        $timeWeather
            ->setSeason((string) ($data['season'] ?? 'SPRING'))
            ->setTimeOfDay((string) ($data['time_of_day'] ?? 'MORNING'))
            ->setWeather((string) ($data['weather'] ?? 'CLEAR'));
    }

    protected function toArray(TimeWeather $timeWeather): array
    {
        return [
            'id' => $timeWeather->getId(),
            'season' => $timeWeather->getSeason(),
            'time_of_day' => $timeWeather->getTimeOfDay(),
            'weather' => $timeWeather->getWeather(),
            'created_at' => $timeWeather->getCreatedAt()?->format(\DateTimeInterface::ATOM),
            'updated_at' => $timeWeather->getUpdatedAt()?->format(\DateTimeInterface::ATOM),
        ];
    }
}