<?php

namespace App\Factory;

use App\Dto\UserCreationDto;
use App\Entity\User;
use App\Interface\UserFactoryInterface;

class UserFactory implements UserFactoryInterface
{
    public function create(UserCreationDto $dto): User
    {
        return new User($dto->name);
    }
}