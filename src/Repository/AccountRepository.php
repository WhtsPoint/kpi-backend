<?php

namespace App\Repository;

use App\Entity\Account;
use App\Exception\AccountNotFoundException;
use App\Interface\AccountRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class AccountRepository implements AccountRepositoryInterface
{
    private EntityRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager
            ->getRepository(Account::class);
    }

    public function create(Account $account): void
    {
        $this->entityManager->persist($account);
    }

    /**
     * @throws AccountNotFoundException
     */
    public function getById(string $id): Account
    {
        $account = $this->repository->find($id);

        if ($account === null) {
            throw new AccountNotFoundException();
        }

        return $account;
    }

    public function delete(Account $account): void
    {
        $this->entityManager->remove($account);
    }

    public function isExistsWithUser(string $userId): bool
    {
        $query = $this->entityManager->createQuery(
            'SELECT COUNT(a.id) as count FROM App\Entity\Account a JOIN a.user u WHERE u.id = :userId'
        );
        $query->setParameter('userId', $userId);
        $count = $query->getSingleScalarResult();

        return $count > 0;
    }
}