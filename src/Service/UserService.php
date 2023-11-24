<?php

namespace App\Service;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
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

    /**
     * @throws UserNotFoundException
     */
    public function deleteById(string $id): void
    {
        $user = $this->repository->getById($id);

        $this->repository->deleteByEntity($user);
        $this->flusher->flush();
    }
}