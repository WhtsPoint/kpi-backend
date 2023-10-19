<?php

namespace App\Service;

use App\Dto\CategoryCreationDto;
use App\Dto\CategoryCreationResultDto;
use App\Interface\CategoryFactoryInterface;
use App\Interface\CategoryRepositoryInterface;
use App\Interface\CategoryServiceInterface;
use App\Interface\FlusherInterface;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        protected CategoryRepositoryInterface $repository,
        protected CategoryFactoryInterface $factory,
        protected FlusherInterface $flusher
    ) {}

    public function create(CategoryCreationDto $dto): CategoryCreationResultDto
    {
        $category = $this->factory->create($dto);

        $this->repository->create($category);
        $this->flusher->flush();

        return new CategoryCreationResultDto($category->getId());
    }
}