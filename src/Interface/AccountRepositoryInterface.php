<?php

namespace App\Interface;

use App\Entity\Account;
use App\Exception\AccountNotFoundException;

interface AccountRepositoryInterface
{
    public function create(Account $account): void;
    /**
     * @throws AccountNotFoundException
     */
    public function getById(string $id): Account;
    public function isExistsWithUser(string $userId): bool;
    public function delete(Account $account): void;

}