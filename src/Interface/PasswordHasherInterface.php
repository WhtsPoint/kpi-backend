<?php

namespace App\Interface;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
    public function isValid(string $hash, string $expect): bool;
}