<?php

namespace App\Interface;

use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    public function create(User $user): void;

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