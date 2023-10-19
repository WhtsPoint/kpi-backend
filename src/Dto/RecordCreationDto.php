<?php

namespace App\Dto;

class RecordCreationDto
{
    public function __construct(
        public string $userId,
        public string $categoryId,
        public int $amountSpent
    ) {}
}