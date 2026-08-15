<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Garment
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(length: 20)]
    private string $category = 'TOP';

    #[ORM\Column(length: 100)]
    private string $subCategory = '';

    #[ORM\Column(length: 20)]
    private string $fit = 'REGULAR';

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $fabric = [];

    #[ORM\Column(type: 'json', options: ['default' => '{}'])]
    private array $primaryColor = [];

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $secondaryColor = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $pattern = null;

    #[ORM\Column(type: 'json', options: ['default' => '[]'])]
    private array $tags = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getSubCategory(): string
    {
        return $this->subCategory;
    }

    public function setSubCategory(string $subCategory): self
    {
        $this->subCategory = $subCategory;
        return $this;
    }

    public function getFit(): string
    {
        return $this->fit;
    }

    public function setFit(string $fit): self
    {
        $this->fit = $fit;
        return $this;
    }

    public function getFabric(): array
    {
        return $this->fabric;
    }

    public function setFabric(array $fabric): self
    {
        $this->fabric = $fabric;
        return $this;
    }

    public function getPrimaryColor(): array
    {
        return $this->primaryColor;
    }

    public function setPrimaryColor(array $primaryColor): self
    {
        $this->primaryColor = $primaryColor;
        return $this;
    }

    public function getSecondaryColor(): ?array
    {
        return $this->secondaryColor;
    }

    public function setSecondaryColor(?array $secondaryColor): self
    {
        $this->secondaryColor = $secondaryColor;
        return $this;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(?string $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }
}
