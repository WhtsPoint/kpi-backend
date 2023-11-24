<?php

namespace App\Entity;

use App\Exception\InvalidAdditionToBillException;
use App\ValueObject\Bill;
use App\ValueObject\Uuid;

class Account
{
    private Uuid $id;
    private Bill $bill;

    public function __construct(Bill $bill)
    {
        $this->id = Uuid::create();
        $this->bill = $bill;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBill(): Bill
    {
        return $this->bill;
    }

    /**
     * @throws InvalidAdditionToBillException
     */
    public function addAmountToBill(int $amount): void
    {
        $newBill = $this->bill->add($amount);
        $this->bill = $newBill;
    }
}