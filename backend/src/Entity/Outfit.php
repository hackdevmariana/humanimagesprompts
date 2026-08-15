<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Outfit
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(length: 50)]
    private string $styleCategory = 'CASUAL';

    #[ORM\Column]
    private bool $isPublic = false;

    #[ORM\OneToMany(targetEntity: GarmentSlot::class, mappedBy: 'outfit', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $garments;

    public function __construct()
    {
        $this->garments = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getStyleCategory(): string
    {
        return $this->styleCategory;
    }

    public function setStyleCategory(string $styleCategory): self
    {
        $this->styleCategory = $styleCategory;
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

    public function getGarments(): Collection
    {
        return $this->garments;
    }

    public function addGarment(GarmentSlot $garmentSlot): self
    {
        if (!$this->garments->contains($garmentSlot)) {
            $this->garments->add($garmentSlot);
            $garmentSlot->setOutfit($this);
        }
        return $this;
    }

    public function removeGarment(GarmentSlot $garmentSlot): self
    {
        $this->garments->removeElement($garmentSlot);
        return $this;
    }
}
