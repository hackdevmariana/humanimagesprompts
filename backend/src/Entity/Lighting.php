<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Lighting
{
    use UuidIdentity;

    #[ORM\Column(length: 50)]
    private string $setupType = 'NATURAL';

    #[ORM\Column(length: 50)]
    private string $colorTemperature = 'WARM_2700K';

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $keyLightDirection = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $hardness = null;

    #[ORM\Column(type: 'json', options: ['default' => '{}'], nullable: true)]
    private array $modifiers = [];

    public function getSetupType(): string
    {
        return $this->setupType;
    }

    public function setSetupType(string $setupType): self
    {
        $this->setupType = $setupType;
        return $this;
    }

    public function getColorTemperature(): string
    {
        return $this->colorTemperature;
    }

    public function setColorTemperature(string $colorTemperature): self
    {
        $this->colorTemperature = $colorTemperature;
        return $this;
    }

    public function getKeyLightDirection(): ?string
    {
        return $this->keyLightDirection;
    }

    public function setKeyLightDirection(?string $keyLightDirection): self
    {
        $this->keyLightDirection = $keyLightDirection;
        return $this;
    }

    public function getHardness(): ?string
    {
        return $this->hardness;
    }

    public function setHardness(?string $hardness): self
    {
        $this->hardness = $hardness;
        return $this;
    }

    public function getModifiers(): array
    {
        return $this->modifiers;
    }

    public function setModifiers(array $modifiers): self
    {
        $this->modifiers = $modifiers;
        return $this;
    }
}
