<?php

namespace App\Interface;

use App\Dto\CategoryCreationDto;
use App\Dto\CategoryCreationResultDto;

interface CategoryServiceInterface
{
    public function create(CategoryCreationDto $dto): CategoryCreationResultDto;
}