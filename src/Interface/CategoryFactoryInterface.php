<?php

namespace App\Interface;

use App\Dto\CategoryCreationDto;
use App\Entity\Category;

interface CategoryFactoryInterface
{
    public function create(CategoryCreationDto $dto): Category;
}