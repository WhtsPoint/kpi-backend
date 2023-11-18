<?php

namespace App\Dto;

use App\Entity\User;

class AccountCreationDto
{
    public function __construct(
        public int $amount,
        public string $userId
    ) {}
}