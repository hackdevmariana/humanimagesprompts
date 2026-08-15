<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class GarmentSlot
{
    use UuidIdentity;

    #[ORM\Column(length: 30)]
    private string $slotType = 'BASE_LAYER';

    #[ORM\ManyToOne(targetEntity: Outfit::class, inversedBy: 'garments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Outfit $outfit = null;

    #[ORM\ManyToOne(targetEntity: Garment::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Garment $garment = null;

    public function getSlotType(): string
    {
        return $this->slotType;
    }

    public function setSlotType(string $slotType): self
    {
        $this->slotType = $slotType;
        return $this;
    }

    public function getOutfit(): ?Outfit
    {
        return $this->outfit;
    }

    public function setOutfit(?Outfit $outfit): self
    {
        $this->outfit = $outfit;
        return $this;
    }

    public function getGarment(): ?Garment
    {
        return $this->garment;
    }

    public function setGarment(?Garment $garment): self
    {
        $this->garment = $garment;
        return $this;
    }
}
