<?php

namespace App\Interface;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
use App\Exception\UserNotFoundException;
use App\Exception\UserWithThisLoginExistsException;

interface UserServiceInterface
{
    /**
     * @throws UserWithThisLoginExistsException
     */
    public function create(UserCreationDto $dto): UserCreationResultDto;
    /**
     * @throws UserNotFoundException
     */
    public function deleteById(string $id): void;
}