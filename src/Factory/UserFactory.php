<?php

namespace App\Factory;

use App\Dto\HashPasswordDto;
use App\Dto\UserCreationDto;
use App\Entity\User;
use App\Interface\PasswordHasherInterface;
use App\Interface\UserFactoryInterface;

class UserFactory implements UserFactoryInterface
{
    public function __construct(
        protected PasswordHasherInterface $passwordHasher
    ) {}

    public function create(UserCreationDto $dto): User
    {
        $hashPasswordDto = new HashPasswordDto(
            $dto->password,
            $this->passwordHasher
        );

        return new User(
            $dto->name,
            $dto->login,
            $hashPasswordDto
        );
    }
}