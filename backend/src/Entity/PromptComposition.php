<?php

namespace App\Entity;

use App\Enum\CompositionStatusEnum;
use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class PromptComposition
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title = '';

    #[ORM\Column(type: 'string', length: 36)]
    private string $userId = '';

    #[ORM\ManyToOne(targetEntity: Character::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Character $character = null;

    #[ORM\ManyToOne(targetEntity: Outfit::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Outfit $outfit = null;

    #[ORM\ManyToOne(targetEntity: Pose::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Pose $pose = null;

    #[ORM\ManyToOne(targetEntity: Scene::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Scene $scene = null;

    #[ORM\Column(type: 'string', length: 20, enumType: CompositionStatusEnum::class, options: ['default' => 'DRAFT'])]
    private CompositionStatusEnum $status = CompositionStatusEnum::DRAFT;

    #[ORM\Column(type: 'json', options: ['default' => '[]'])]
    private array $appliedOverrides = [];

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $targetModelHint = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;
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

    public function getPose(): ?Pose
    {
        return $this->pose;
    }

    public function setPose(?Pose $pose): self
    {
        $this->pose = $pose;
        return $this;
    }

    public function getScene(): ?Scene
    {
        return $this->scene;
    }

    public function setScene(?Scene $scene): self
    {
        $this->scene = $scene;
        return $this;
    }

    public function getStatus(): CompositionStatusEnum
    {
        return $this->status;
    }

    public function setStatus(CompositionStatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getAppliedOverrides(): array
    {
        return $this->appliedOverrides;
    }

    public function setAppliedOverrides(array $appliedOverrides): self
    {
        $this->appliedOverrides = $appliedOverrides;
        return $this;
    }

    public function getTargetModelHint(): ?string
    {
        return $this->targetModelHint;
    }

    public function setTargetModelHint(?string $targetModelHint): self
    {
        $this->targetModelHint = $targetModelHint;
        return $this;
    }
}
