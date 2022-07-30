<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[ORM\Entity(repositoryClass: HistoryRepository::class), HasLifecycleCallbacks]
#[ORM\Table(name: 'history')]
class History extends BaseEntity
{
    #[ORM\Column(name: 'temperature', type: 'float', nullable: false)]
    private float $temperature;

    #[ORM\Column(name: 'cloudy', type: 'integer', nullable: false)]
    private int $cloudy;

    #[ORM\Column(name: 'wind', type: 'float', nullable: false)]
    private float $wind;

    #[ORM\Column(name: 'description', type: 'string', nullable: false)]
    private string $description;

    #[ORM\Column(name: 'longitude', type: 'float', nullable: false)]
    private float $longitude;

    #[ORM\Column(name: 'latitude', type: 'float', nullable: false)]
    private float $latitude;

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

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

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

