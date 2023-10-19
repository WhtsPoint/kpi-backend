<?php

namespace App\Entity;

use App\ValueObject\Uuid;

class Category
{
    private Uuid $id;

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
}