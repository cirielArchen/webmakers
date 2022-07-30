<?php

declare(strict_types=1);

namespace App\Service\Manager;

use App\Entity\History;
use App\Repository\HistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use stdClass;

class HistoryManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
        
    }

    public function listPaginated(int $page, int $limit): Paginator
    {
        return $this->getRepository()->listPaginated($page, $limit);
    }

    public function averageTemperature(): float
    {
        return $this->getRepository()->averageTemperature();
    }

    public function maxTemperature(): float
    {
        return $this->getRepository()->maxTemperature();
    }

    public function minTemperature(): float
    {
        return $this->getRepository()->minTemperature();
    }

    public function frequentlySearchedCity(): array
    {
        return $this->getRepository()->frequentlySearchedCity();
    }

    public function save(History $history, string $json): History
    {
        $history = $this->mapApiDataOnHistory($history, json_decode($json));

        return $this->getRepository()->save($history);
    }

    private function mapApiDataOnHistory(History $history, stdClass $data): History
    {
        $history->setTemperature($data->main->temp);
        $history->setCloudy($data->clouds->all);
        $history->setWind($data->wind->speed);
        $history->setDescription($data->weather[0]->description);
        $history->setLongitude($data->coord->lon);
        $history->setLatitude($data->coord->lat);
        $history->setCity('Brak miejscowości');
        if (!empty($data->name)) {
            $history->setCity($data->name);
        }

        return $history;
    }

    private function getRepository(): HistoryRepository
    {
        return $this->entityManager->getRepository(History::class);
    }
}

