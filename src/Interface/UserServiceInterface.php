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
    public function delete(string $id): void;

    /**
     * @throws UserNotFoundException
     */
    public function getById(string $id): User;
    /**
     * @return array<User>
     */
    public function getAll(): array;
}