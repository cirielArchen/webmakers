<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\History;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<History>
 */
class HistoryRepository extends EntityRepository
{
    public function save(History $entity, bool $flush = true): History
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }

        return $entity;
    }
}

