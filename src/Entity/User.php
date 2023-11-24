<?php

namespace App\Entity;

use App\ValueObject\Uuid;

class User
{
    private Uuid $id;
    private ?Account $account = null;

    public function __construct(
        private string $name
    ) {
        $this->id = Uuid::create();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }
}