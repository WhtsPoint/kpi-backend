<?php

namespace App\Util\Doctrine\Type;

use App\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class UuidType extends StringType
{
    public const type = 'uuid';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Uuid
    {
        return $value ? new Uuid((string) $value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Uuid ? $value->get() : $value;
    }

    public function getName(): string
    {
        return self::type;
    }
}