<?php

namespace App\Dto;

use App\ValueObject\Uuid;

class CategoryCreationResultDto
{
    public function __construct(
        public Uuid $id
    ) {}
}