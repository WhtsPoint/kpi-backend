<?php

namespace App\Interface;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
use App\Entity\User;
use App\Exception\UserNotFoundException;

interface UserServiceInterface
{
    public function create(UserCreationDto $dto): UserCreationResultDto;
    /**
     * @throws UserNotFoundException
     */
    public function deleteById(string $id): void;
}