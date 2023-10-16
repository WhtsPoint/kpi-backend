<?php

namespace App\ValueObject;

use App\Interface\ValueObjectInterface;
use InvalidArgumentException;
use Symfony\Component\Uid\Uuid as UuidHelper;

class Uuid implements ValueObjectInterface
{
    private string $value;

    public function __construct($value)
    {
        if (!is_string($value) || !UuidHelper::isValid($value)) {
            throw new InvalidArgumentException('Invalid uuid value');
        }

        $this->value = $value;
    }

    public function get(): string
    {
        return $this->value;
    }

    public static function create(): self
    {
        return new Uuid((string) UuidHelper::v4());
    }

    public function __toString(): string
    {
        return $this->get();
    }
}