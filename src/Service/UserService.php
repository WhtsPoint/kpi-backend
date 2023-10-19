<?php

namespace App\Service;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Interface\FlusherInterface;
use App\Interface\UserFactoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Interface\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $repository,
        protected UserFactoryInterface $factory,
        protected FlusherInterface $flusher
    ) {}

    public function create(UserCreationDto $dto): UserCreationResultDto
    {
        $user = $this->factory->create($dto);

        $this->repository->create($user);
        $this->flusher->flush();

        return new UserCreationResultDto($user->getId());
    }
}