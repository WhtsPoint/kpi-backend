<?php

namespace App\Service;

use App\Dto\RecordCreationDto;
use App\Dto\RecordCreationResultDto;
use App\Exception\AccountNotFoundException;
use App\Exception\CategoryNotFoundException;
use App\Exception\InvalidAdditionToBillException;
use App\Exception\LackOfAmountException;
use App\Exception\RecordNotFoundException;
use App\Exception\UserNotFoundException;
use App\Interface\AccountRepositoryInterface;
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
        protected AccountRepositoryInterface $accountRepository,
        protected FlusherInterface $flusher
    ) {}


    /**
     * @throws UserNotFoundException
     * @throws CategoryNotFoundException
     * @throws LackOfAmountException
     * @throws AccountNotFoundException
     */
    public function create(RecordCreationDto $dto): RecordCreationResultDto
    {
        $user = $this->userRepository->getById($dto->userId);
        $category = $this->categoryRepository->getById($dto->categoryId);
        $record = $this->factory->create($dto->amountSpent);
        $account = $user->getAccount();

        if ($account === null) {
            throw new AccountNotFoundException();
        }

        $record->setUser($user);
        $record->setCategory($category);

        $this->repository->create($record);

        try {
            $account->addAmountToBill(-1 * $dto->amountSpent);
        } catch (InvalidAdditionToBillException) {
            throw new LackOfAmountException();
        }

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