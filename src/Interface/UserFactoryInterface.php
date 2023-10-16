<?php

namespace App\Interface;

use App\Dto\UserCreationDto;
use App\Entity\User;

interface UserFactoryInterface
{
    public function create(UserCreationDto $dto): User;
}