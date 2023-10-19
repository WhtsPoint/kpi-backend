<?php

namespace App\Dto;

class CategoryCreationDto
{
    public function __construct(
        public string $name
    ) {}
}