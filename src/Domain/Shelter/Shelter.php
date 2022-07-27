<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Address;
use App\SharedKernel\Domain\Identifier\Uuid;

class Shelter
{
    public function __construct(
        private readonly Uuid $id,
        private string $name,
        private Address $address,
        private bool $verified = false
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function rename(string $newName): void
    {
        $this->name = $newName;
    }

    public function changeAddress(Address $newAddress): void
    {
        $this->address = $newAddress;
    }

    public function verify(): void
    {
        $this->verified = true;
    }

    public function refute(): void
    {
        $this->verified = false;
    }
}
