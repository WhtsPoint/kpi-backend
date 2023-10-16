<?php

namespace App\Dto;

use App\ValueObject\Uuid;

class UserCreationResultDto
{
    public function __construct(
        public Uuid $id
    ) {}
}