<?php

namespace App\Dto;

class TopUpAccountResultDto
{
    public function __construct(
        public int $newAmount
    ) {}
}