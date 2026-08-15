<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Scene
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title = '';

    #[ORM\Column(length: 50)]
    private string $environmentType = 'URBAN';

    #[ORM\Column(type: 'text')]
    private string $locationDetails = '';

    #[ORM\ManyToOne(targetEntity: Lighting::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Lighting $lighting = null;

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $cameraAndLens = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $weatherAndAtmosphere = [];

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getEnvironmentType(): string
    {
        return $this->environmentType;
    }

    public function setEnvironmentType(string $environmentType): self
    {
        $this->environmentType = $environmentType;
        return $this;
    }

    public function getLocationDetails(): string
    {
        return $this->locationDetails;
    }

    public function setLocationDetails(string $locationDetails): self
    {
        $this->locationDetails = $locationDetails;
        return $this;
    }

    public function getLighting(): ?Lighting
    {
        return $this->lighting;
    }

    public function setLighting(?Lighting $lighting): self
    {
        $this->lighting = $lighting;
        return $this;
    }

    public function getCameraAndLens(): array
    {
        return $this->cameraAndLens;
    }

    public function setCameraAndLens(array $cameraAndLens): self
    {
        $this->cameraAndLens = $cameraAndLens;
        return $this;
    }

    public function getWeatherAndAtmosphere(): array
    {
        return $this->weatherAndAtmosphere;
    }

    public function setWeatherAndAtmosphere(array $weatherAndAtmosphere): self
    {
        $this->weatherAndAtmosphere = $weatherAndAtmosphere;
        return $this;
    }
}
