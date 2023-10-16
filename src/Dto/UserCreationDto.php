<?php

namespace App\Dto;

class UserCreationDto
{
    public function __construct(
        public string $name
    ) {}
}