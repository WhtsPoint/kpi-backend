<?php

namespace App\Interface;

use App\Dto\AccountCreationDto;
use App\Dto\AccountCreationResultDto;
use App\Dto\TopUpAccountDto;
use App\Dto\TopUpAccountResultDto;
use App\Exception\AccountNotFoundException;
use App\Exception\InvalidAdditionToBillException;
use App\Exception\UserAlreadyHasAccountException;
use App\Exception\UserNotFoundException;

interface AccountServiceInterface
{
    /**
     * @throws UserNotFoundException
     * @throws UserAlreadyHasAccountException
     */
    public function createForUser(AccountCreationDto $dto): AccountCreationResultDto;
    /**
     * @throws AccountNotFoundException
     * @throws InvalidAdditionToBillException
     */
    public function topUp(TopUpAccountDto $dto): TopUpAccountResultDto;
    /**
     * @throws AccountNotFoundException
     */
    public function delete(string $id): void;
}