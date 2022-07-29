<?php

declare(strict_types=1);

namespace App\Service\Manager;

use App\Entity\History;
use App\Repository\HistoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class HistoryManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
        
    }

    public function list(): array
    {
        return $this->getRepository()->list();
    }

    public function find(int $id): ?History
    {
        return $this->getRepository()->find($id);
    }

    public function save(History $history): History
    {
        return $this->getRepository()->save($history);
    }

    private function getRepository(): HistoryRepository
    {
        return $this->entityManager->getRepository(History::class);
    }
}

