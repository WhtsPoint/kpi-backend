<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Interface\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository implements UserRepositoryInterface
{
    protected EntityRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager
            ->getRepository(User::class);
    }

    public function create(User $user): void
    {
        $this->entityManager->persist($user);
    }

    /**
     * @throws UserNotFoundException
     */
    public function delete(string $id): void
    {
        $this->isExistsOrException($id);

        $query = $this->entityManager->createQuery(
            'DELETE FROM App\Entity\User u WHERE u.id = :id'
        );
        $query->execute(['id' => $id]);
    }

    /**
     * @throws UserNotFoundException
     */
    public function getById(string $id): User
    {
        $user = $this->repository->find($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @throws UserNotFoundException
     */
    private function isExistsOrException(string $id): void
    {
        if ($this->repository->count(['id' => $id]) === 0) {
            throw new UserNotFoundException();
        }
    }
}