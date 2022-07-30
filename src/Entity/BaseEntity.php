<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class BaseEntity implements EntityBaseInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(name: 'created_at', type: 'datetimetz', nullable: false)]
    protected ?DateTime $createdAt = null;

    #[ORM\Column(name: 'updated_at', type: 'datetimetz', nullable: true)]
    protected ?DateTime $updatedAt = null;

    #[ORM\PrePersist]
    #[ORM\PostPersist]
    public function updatedTimestamps(): void
    {
        $now = new DateTime();

        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt($now);
        } else {
            $this->setUpdatedAt($now);
        }
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

