<?php

namespace App\Util\Doctrine\Type;

use App\ValueObject\Bill;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BillType extends StringType
{
    public const type = 'bill';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Bill
    {
        return $value ? new Bill((string) $value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Bill ? $value->get() : $value;
    }

    public function getName(): string
    {
        return self::type;
    }
}