<?php

namespace App\Dto;

use App\ValueObject\Uuid;

class RecordCreationResultDto
{
    public function __construct(
        public Uuid $id
    ) {}
}