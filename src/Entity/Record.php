<?php

namespace App\Entity;

use App\ValueObject\Uuid;
use DateTimeImmutable;

class Record
{
    private Uuid $id;
    private ?User $user = null;
    private ?Category $category = null;

    public function __construct(
        private readonly DateTimeImmutable $createdAt,
        private int $amountSpent
    ) {
        $this->id = Uuid::create();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getAmountSpent(): int
    {
        return $this->amountSpent;
    }

    public function setAmountSpent(int $amountSpent): void
    {
        $this->amountSpent = $amountSpent;
    }
}