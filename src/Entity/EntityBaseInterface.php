<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\OrM\Mapping as ORM;

interface EntityBaseInterface
{
    #[ORM\PrePersist]
    #[ORM\PostPersist]
    public function updatedTimestamps(): void;

    public function getCreatedAt(): ?DateTime;

    public function setCreatedAt(DateTime $createdAt): self;

    public function getUpdatedAt(): ?DateTime;

    public function setUpdatedAt(DateTime $updatedAt): self;
}

