<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\OrM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History extends BaseEntity
{
    #[ORM\Column(name: 'temperature', type: 'integer', nullable: false)]
    private int $temperature;

    #[ORM\Column(name: 'cloudy', type: 'integer', nullable: false)]
    private int $cloudy;

    #[ORM\Column(name: 'wind', type: 'integer', nullable: false)]
    private int $wind;

    #[ORM\Column(name: 'description', type: 'Integer', nullable: false)]
    private int $description;

    #[ORM\Column(name: 'coordinates', type: 'string', nullable: false)]
    private string $coordinates;

    #[ORM\Column(name: 'city', type: 'string', nullable: false)]
    private string $city;

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getCloudy()
    {
        return $this->cloudy;
    }

    public function setCloudy($cloudy)
    {
        $this->cloudy = $cloudy;

        return $this;
    }

    public function getWind()
    {
        return $this->wind;
    }
 
    public function setWind($wind)
    {
        $this->wind = $wind;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }

    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
}

