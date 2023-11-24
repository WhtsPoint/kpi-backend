<?php

namespace App\Repository;

use App\Entity\Account;
use App\Exception\AccountNotFoundException;
use App\Interface\AccountRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
            'SELECT COUNT(u.id) FROM App\Entity\User u JOIN u.account a WHERE u.id = :userId AND a IS NOT NULL'
        );
        $query->setParameter('userId', $userId);
        $count = $query->getSingleScalarResult();

        return $count !== 0;
    }

    /**
     * @throws AccountNotFoundException
     * @throws NonUniqueResultException
     */
    public function getByUserId(string $userId): Account
    {
        $query = $this->entityManager->createQuery(
            'SELECT a FROM App\Entity\Account a JOIN a.user u WHERE u.id = :userId'
        );
        $query->setParameter('userId', $userId);

        try {
            /** @var Account $account */
            $account = $query->getSingleResult();
        } catch (NoResultException) {
            throw new AccountNotFoundException();
        }
        return $account;
    }
}