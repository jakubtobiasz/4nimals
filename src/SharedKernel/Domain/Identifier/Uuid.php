<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain\Identifier;

class Uuid
{
    private const TYPE = 4;

    private function __construct(private readonly string $uuid)
    {
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

    public static function create(): self
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

        return new self($generatedUuid);
    }

    public static function fromString(string $uuid): self
    {
        if (! self::isValid($uuid)) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        return new self($uuid);
    }

    public static function isValid(string $uuid): bool
    {
        if (! preg_match('{^[0-9a-f]{8}(?:-[0-9a-f]{4}){3}-[0-9a-f]{12}$}Di', $uuid)) {
            return false;
        }

        return static::class === __CLASS__ || static::TYPE === (int) $uuid[14];
    }
}
