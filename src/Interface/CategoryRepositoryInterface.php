<?php

namespace App\Interface;

use App\Entity\Category;
use App\Exception\CategoryNotFoundException;

interface CategoryRepositoryInterface
{
    public function create(Category $category): void;

    /**
     * @throws CategoryNotFoundException
     */
    public function getById(string $id): Category;
    /**
     * @throws CategoryNotFoundException
     */
    public function delete(string $id): void;
}