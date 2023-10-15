<?php

namespace App\Dto;

class HealthcheckDto
{
    public function __construct(
        public readonly string $date,
        public readonly string $status
    ) {}
}