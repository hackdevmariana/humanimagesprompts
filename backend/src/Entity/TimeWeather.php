<?php

namespace App\Entity;

use App\Traits\UuidIdentity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class TimeWeather
{
    use UuidIdentity;

    #[ORM\Column(length: 50)]
    private string $season = 'SPRING';

    #[ORM\Column(length: 50)]
    private string $timeOfDay = 'MORNING';

    #[ORM\Column(length: 50)]
    private string $weather = 'CLEAR';

    public function getSeason(): string
    {
        return $this->season;
    }

    public function setSeason(string $season): self
    {
        $this->season = $season;
        return $this;
    }

    public function getTimeOfDay(): string
    {
        return $this->timeOfDay;
    }

    public function setTimeOfDay(string $timeOfDay): self
    {
        $this->timeOfDay = $timeOfDay;
        return $this;
    }

    public function getWeather(): string
    {
        return $this->weather;
    }

    public function setWeather(string $weather): self
    {
        $this->weather = $weather;
        return $this;
    }
}