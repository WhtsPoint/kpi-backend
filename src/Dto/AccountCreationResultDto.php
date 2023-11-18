<?php

namespace App\Dto;

use App\ValueObject\Uuid;

class AccountCreationResultDto
{
    public function __construct(
        public Uuid $id
    ) {}
}