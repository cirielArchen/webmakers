<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\History;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends EntityRepository<History>
 */
class HistoryRepository extends EntityRepository
{
    public function listPaginated(int $page, int $limit = 10): Paginator
    {
        $offset = $page * $limit - $limit;
        $query = $this->createQueryBuilder('h')
            ->orderBy('h.id', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();

        return new Paginator($query, $fetchJoinCollection = true);
    }

    public function averageTemperature(): float
    {
        return $this->createQueryBuilder('h')
            ->select('avg(h.temperature)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function maxTemperature(): float
    {
        return $this->createQueryBuilder('h')
            ->select('max(h.temperature)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function minTemperature(): float
    {
        return $this->createQueryBuilder('h')
            ->select('min(h.temperature)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function frequentlySearchedCity(): array
    {
        return $this->createQueryBuilder('h')
            ->select('h.city')
            ->groupBy('h.city')
            ->orderBy('count(h.city)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

    public function save(History $entity, bool $flush = true): History
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }

        return $entity;
    }
}

