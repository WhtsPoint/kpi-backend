<?php

namespace App\Repository;

use App\Entity\Category;
use App\Exception\CategoryNotFoundException;
use App\Interface\CategoryRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected EntityRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager
            ->getRepository(Category::class);
    }

    public function create(Category $category): void
    {
        $this->entityManager->persist($category);
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function getById(string $id): Category
    {
        $category = $this->repository->find($id);

        if ($category === null) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function delete(string $id): void
    {
        $this->isExistsOrException($id);

        $query = $this->entityManager->createQuery(
            'DELETE FROM App\Entity\Category c WHERE c.id = :id'
        );
        $query->execute(['id' => $id]);
    }

    /**
     * @throws CategoryNotFoundException
     */
    private function isExistsOrException(string $id): void
    {
        if ($this->repository->count(['id' => $id]) === 0) {
            throw new CategoryNotFoundException();
        }
    }
}