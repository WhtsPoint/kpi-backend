<?php

namespace App\Interface;

use App\Entity\Account;
use App\Entity\User;
use InvalidArgumentException;

interface AccountFactoryInterface
{
    /**
     * @throws InvalidArgumentException when bill value is invalid
     */
    public function create(int $amount, User $user): Account;
}