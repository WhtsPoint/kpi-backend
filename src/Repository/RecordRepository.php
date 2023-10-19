<?php

namespace App\Repository;

use App\Dto\RecordSearchParamsDto;
use App\Entity\Record;
use App\Exception\RecordNotFoundException;
use App\Interface\RecordRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class RecordRepository implements RecordRepositoryInterface
{
    protected EntityRepository $repository;

    public function __construct(
        protected EntityManagerInterface $entityManager
    ) {
        $this->repository = $this->entityManager
            ->getRepository(Record::class);
    }

    public function create(Record $record): void
    {
        $this->entityManager->persist($record);
    }

    /**
     * @throws RecordNotFoundException
     */
    public function getById(string $id): Record
    {
        $record = $this->repository->find($id);

        if ($record === null) {
            throw new RecordNotFoundException();
        }

        return $record;
    }

    /**
     * @return array<Record>
     */
    public function get(RecordSearchParamsDto $dto): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('r')
            ->from('App\Entity\Record', 'r')
            ->join('r.user', 'u')
            ->join('r.category', 'c');

        if ($dto->userId) {
            $queryBuilder->andWhere('u.id = :userId')
                ->setParameter('userId', $dto->userId);
        }

        if ($dto->categoryId) {
            $queryBuilder->andWhere('c.id = :categoryId')
                ->setParameter('categoryId', $dto->categoryId);
        }

        return $queryBuilder->getQuery()->getArrayResult();
    }

    public function delete(Record $record): void
    {
        $this->entityManager->remove($record);
    }
}