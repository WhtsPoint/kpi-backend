<?php

namespace App\Dto;

class RecordSearchParamsDto
{
    public function __construct(
        public ?string $userId = null,
        public ?string $categoryId = null
    ) {}
}