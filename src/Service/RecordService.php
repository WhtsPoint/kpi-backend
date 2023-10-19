<?php

namespace App\Service;

use App\Dto\RecordCreationDto;
use App\Dto\RecordCreationResultDto;
use App\Exception\CategoryNotFoundException;
use App\Exception\RecordNotFoundException;
use App\Exception\UserNotFoundException;
use App\Interface\CategoryRepositoryInterface;
use App\Interface\FlusherInterface;
use App\Interface\RecordFactoryInterface;
use App\Interface\RecordRepositoryInterface;
use App\Interface\RecordServiceInterface;
use App\Interface\UserRepositoryInterface;

class RecordService implements RecordServiceInterface
{
    public function __construct(
        protected RecordRepositoryInterface $repository,
        protected RecordFactoryInterface $factory,
        protected UserRepositoryInterface $userRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected FlusherInterface $flusher
    ) {}


    /**
     * @throws UserNotFoundException
     * @throws CategoryNotFoundException
     */
    public function create(RecordCreationDto $dto): RecordCreationResultDto
    {
        $user = $this->userRepository->getById($dto->userId);
        $category = $this->categoryRepository->getById($dto->categoryId);
        $record = $this->factory->create($dto->amountSpent);

        $record->setUser($user);
        $record->setCategory($category);

        $this->repository->create($record);
        $this->flusher->flush();

        return new RecordCreationResultDto($record->getId());
    }

    /**
     * @throws RecordNotFoundException
     */
    public function delete(string $id): void
    {
        $record = $this->repository->getById($id);

        $this->repository->delete($record);
        $this->flusher->flush();
    }
}