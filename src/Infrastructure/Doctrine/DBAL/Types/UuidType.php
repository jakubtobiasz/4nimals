<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types;

use App\SharedKernel\Domain\Identifier\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class UuidType extends Type
{
    public const NAME = 'uuid';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return strval($value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Uuid
    {
        return Uuid::fromString($value);
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
