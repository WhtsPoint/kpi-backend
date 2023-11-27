<?php

namespace App\Util;

use App\Interface\PasswordHasherInterface;

class PasswordHasher implements PasswordHasherInterface
{
    public function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isValid(string $hash, string $expect): bool
    {
        return password_verify($hash, $expect);
    }
}