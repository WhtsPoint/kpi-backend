<?php

namespace App\ValueObject;

use App\Exception\InvalidAdditionToBillException;
use App\Interface\ValueObjectInterface;
use InvalidArgumentException;

class Bill implements ValueObjectInterface
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException(
                'Bill must have only positive value'
            );
        }

        $this->value = $value;
    }

    public function get(): int
    {
        return $this->value;
    }

    /**
     * @throws InvalidAdditionToBillException
     */
    public function add(int $amount): self
    {
        $newAmount = $this->value + $amount;

        if ($newAmount < 0) {
            throw new InvalidAdditionToBillException();
        }

        return new self($newAmount);
    }
}