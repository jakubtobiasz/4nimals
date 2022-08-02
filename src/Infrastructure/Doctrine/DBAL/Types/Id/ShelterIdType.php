<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Types\Id;

use App\Domain\Shelter\ShelterId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class ShelterIdType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return strval($value);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ShelterId
    {
        return ShelterId::fromString($value);
    }

    public function getName(): string
    {
        return 'shelter_id';
    }
}
