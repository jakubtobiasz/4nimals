<?php

declare(strict_types=1);

namespace spec\App\Infrastructure\Doctrine\DBAL\Types;

use App\SharedKernel\Domain\Identifier\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use PhpSpec\ObjectBehavior;

class UuidTypeSpec extends ObjectBehavior
{
    function it_is_type()
    {
        $this->shouldHaveType(Type::class);
    }

    function it_has_uuid_name()
    {
        $this->getName()->shouldReturn('uuid');
    }

    function it_returns_sql_declaration(AbstractPlatform $platform)
    {
        $column = ['some' => 'array'];

        $platform->getGuidTypeDeclarationSQL($column)->shouldBeCalled()->willReturn('some sql');

        $this->getSQLDeclaration($column, $platform)->shouldReturn('some sql');
    }

    function it_converts_to_database_value(AbstractPlatform $platform)
    {
        $uuid = Uuid::fromString('152b1f12-c91e-41a9-9518-f676dc610de2');

        $this->convertToDatabaseValue($uuid, $platform)->shouldReturn('152b1f12-c91e-41a9-9518-f676dc610de2');
    }

    function it_converts_to_php_value(AbstractPlatform $platform)
    {
        $uuid = '152b1f12-c91e-41a9-9518-f676dc610de2';

        $result = $this->convertToPHPValue($uuid, $platform);

        $result->shouldBeAnInstanceOf(Uuid::class);
        $result->__toString()->shouldReturn('152b1f12-c91e-41a9-9518-f676dc610de2');
    }
}
