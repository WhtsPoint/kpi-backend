<?php

namespace App\Interface;

use App\Dto\UserCreationDto;
use App\Dto\UserCreationResultDto;
use App\Entity\User;
use App\Exception\UserNotFoundException;

interface UserServiceInterface
{
    public function create(UserCreationDto $dto): UserCreationResultDto;
}