<?php

namespace App\Service;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
use App\Exception\UserNotFoundException;
use App\Exception\UserWithThisLoginExistsException;
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

    /**
     * @throws UserWithThisLoginExistsException
     */
    public function create(UserCreationDto $dto): UserCreationResultDto
    {
        if ($this->repository->isExistsWithLogin($dto->login)) {
            throw new UserWithThisLoginExistsException();
        }

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