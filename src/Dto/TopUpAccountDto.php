<?php

namespace App\Dto;

class TopUpAccountDto
{
    public function __construct(
        public int $amount,
        public string $accountId
    ) {}
}