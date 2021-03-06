<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain\Identifier;

abstract class Uuid
{
    protected const TYPE = 4;

    protected function __construct(private readonly string $uuid)
    {
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public function toString(): string
    {
        return strval($this);
    }

    public static function create():static
    {
        $uuid = random_bytes(16);
        $uuid[6] = $uuid[6] & "\x0F" | "\x40";
        $uuid[8] = $uuid[8] & "\x3F" | "\x80";
        $uuid = bin2hex($uuid);

        $generatedUuid = sprintf(
            '%s-%s-%s-%s-%s',
            substr($uuid, 0, 8),
            substr($uuid, 8, 4),
            substr($uuid, 12, 4),
            substr($uuid, 16, 4),
            substr($uuid, 20, 12)
        );

        return new static($generatedUuid);
    }

    public static function fromString(string $uuid): static
    {
        if (! static::isValid($uuid)) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        return new static($uuid);
    }

    public static function isValid(string $uuid): bool
    {
        if (! preg_match('{^[0-9a-f]{8}(?:-[0-9a-f]{4}){3}-[0-9a-f]{12}$}Di', $uuid)) {
            return false;
        }

        return static::class === __CLASS__ || static::TYPE === (int) $uuid[14];
    }
}
