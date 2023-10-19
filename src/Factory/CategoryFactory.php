<?php

namespace App\Factory;

use App\Dto\CategoryCreationDto;
use App\Entity\Category;
use App\Interface\CategoryFactoryInterface;

class CategoryFactory implements CategoryFactoryInterface
{
    public function create(CategoryCreationDto $dto): Category
    {
        return new Category($dto->name);
    }
}