<?php

namespace App\Dto;

use App\Interface\PasswordHasherInterface;

class HashPasswordDto
{
    public function __construct(
        public string $password,
        public PasswordHasherInterface $hasher
    ) {}
}