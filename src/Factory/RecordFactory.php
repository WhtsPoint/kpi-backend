<?php

namespace App\Factory;

use App\Entity\Record;
use App\Interface\RecordFactoryInterface;
use DateTimeImmutable;

class RecordFactory implements RecordFactoryInterface
{
    public function create(int $amountSpent): Record
    {
        return new Record(
            new DateTimeImmutable(),
            $amountSpent
        );
    }
}