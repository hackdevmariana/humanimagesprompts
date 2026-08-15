<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Pose
{
    use UuidIdentity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title = '';

    #[ORM\Column(length: 50)]
    private string $category = 'STANDING';

    #[ORM\Column(type: 'text')]
    private string $bodyLanguage = '';

    #[ORM\Column(length: 50)]
    private string $facialExpression = 'NEUTRAL';

    #[ORM\Column]
    private int $expressionIntensity = 5;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $cameraAngle = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $requiredFraming = null;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
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

    public function getBodyLanguage(): string
    {
        return $this->bodyLanguage;
    }

    public function setBodyLanguage(string $bodyLanguage): self
    {
        $this->bodyLanguage = $bodyLanguage;
        return $this;
    }

    public function getFacialExpression(): string
    {
        return $this->facialExpression;
    }

    public function setFacialExpression(string $facialExpression): self
    {
        $this->facialExpression = $facialExpression;
        return $this;
    }

    public function getExpressionIntensity(): int
    {
        return $this->expressionIntensity;
    }

    public function setExpressionIntensity(int $expressionIntensity): self
    {
        $this->expressionIntensity = $expressionIntensity;
        return $this;
    }

    public function getCameraAngle(): ?string
    {
        return $this->cameraAngle;
    }

    public function setCameraAngle(?string $cameraAngle): self
    {
        $this->cameraAngle = $cameraAngle;
        return $this;
    }

    public function getRequiredFraming(): ?string
    {
        return $this->requiredFraming;
    }

    public function setRequiredFraming(?string $requiredFraming): self
    {
        $this->requiredFraming = $requiredFraming;
        return $this;
    }
}
