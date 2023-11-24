<?php

namespace App\Service;

use App\Dto\AccountCreationDto;
use App\Dto\AccountCreationResultDto;
use App\Dto\TopUpAccountDto;
use App\Dto\TopUpAccountResultDto;
use App\Exception\AccountNotFoundException;
use App\Exception\InvalidAdditionToBillException;
use App\Exception\UserAlreadyHasAccountException;
use App\Exception\UserNotFoundException;
use App\Interface\AccountFactoryInterface;
use App\Interface\AccountRepositoryInterface;
use App\Interface\AccountServiceInterface;
use App\Interface\FlusherInterface;
use App\Interface\UserRepositoryInterface;

class AccountService implements AccountServiceInterface
{
    public function __construct(
        protected AccountFactoryInterface $factory,
        protected UserRepositoryInterface $userRepository,
        protected AccountRepositoryInterface $repository,
        protected FlusherInterface $flusher
    ) {}

    /**
     * @throws UserNotFoundException
     * @throws UserAlreadyHasAccountException
     */
    public function createForUser(AccountCreationDto $dto): AccountCreationResultDto
    {
        $isExists = $this->repository->isExistsWithUser($dto->userId);

        if ($isExists === true) {
            throw new UserAlreadyHasAccountException();
        }

        $user = $this->userRepository->getById($dto->userId);
        $account = $this->factory->create($dto->amount, $user);


        $this->repository->create($account);
        $this->flusher->flush();

        return new AccountCreationResultDto($account->getId());
    }

    /**
     * @throws AccountNotFoundException
     * @throws InvalidAdditionToBillException
     */
    public function topUp(TopUpAccountDto $dto): TopUpAccountResultDto
    {
        $account = $this->repository->getById($dto->accountId);

        $account->addAmountToBill($dto->amount);

        $this->flusher->flush();

        return new TopUpAccountResultDto($account->getBill()->get());
    }

    /**
     * @throws AccountNotFoundException
     */
    public function delete(string $id): void
    {
        $account = $this->repository->getById($id);

        $this->repository->delete($account);
        $this->flusher->flush();
    }
}