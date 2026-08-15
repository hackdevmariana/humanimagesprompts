<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Character
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column]
    private bool $isPublic = false;

    #[ORM\Column(length: 50)]
    private string $gender = 'NON_BINARY';

    #[ORM\Column]
    private int $age = 0;

    #[ORM\Column(length: 50)]
    private string $ethnicity = 'MULTIRACIAL';

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $cranialMorphology = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $skinProfile = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $hairProfile = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $eyeProfile = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $facialFeatures = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $currentGrooming = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $currentMakeup = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getEthnicity(): string
    {
        return $this->ethnicity;
    }

    public function setEthnicity(string $ethnicity): self
    {
        $this->ethnicity = $ethnicity;
        return $this;
    }

    public function getCranialMorphology(): array
    {
        return $this->cranialMorphology;
    }

    public function setCranialMorphology(array $cranialMorphology): self
    {
        $this->cranialMorphology = $cranialMorphology;
        return $this;
    }

    public function getSkinProfile(): array
    {
        return $this->skinProfile;
    }

    public function setSkinProfile(array $skinProfile): self
    {
        $this->skinProfile = $skinProfile;
        return $this;
    }

    public function getHairProfile(): array
    {
        return $this->hairProfile;
    }

    public function setHairProfile(array $hairProfile): self
    {
        $this->hairProfile = $hairProfile;
        return $this;
    }

    public function getEyeProfile(): array
    {
        return $this->eyeProfile;
    }

    public function setEyeProfile(array $eyeProfile): self
    {
        $this->eyeProfile = $eyeProfile;
        return $this;
    }

    public function getFacialFeatures(): array
    {
        return $this->facialFeatures;
    }

    public function setFacialFeatures(array $facialFeatures): self
    {
        $this->facialFeatures = $facialFeatures;
        return $this;
    }

    public function getCurrentGrooming(): array
    {
        return $this->currentGrooming;
    }

    public function setCurrentGrooming(array $currentGrooming): self
    {
        $this->currentGrooming = $currentGrooming;
        return $this;
    }

    public function getCurrentMakeup(): array
    {
        return $this->currentMakeup;
    }

    public function setCurrentMakeup(array $currentMakeup): self
    {
        $this->currentMakeup = $currentMakeup;
        return $this;
    }
}
