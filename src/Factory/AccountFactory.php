<?php

namespace App\Factory;

use App\Entity\Account;
use App\Entity\User;
use App\Interface\AccountFactoryInterface;
use App\ValueObject\Bill;
use InvalidArgumentException;

class AccountFactory implements AccountFactoryInterface
{
    /**
     * @throws InvalidArgumentException when bill value is invalid
     */
    public function create(int $amount, User $user): Account
    {
        $bill = new Bill($amount);
        $account = new Account($bill);

        $user->setAccount($account);

        return $account;
    }
}