<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Address;
use App\SharedKernel\Domain\Aggregate;

class Shelter extends Aggregate
{
    public function __construct(
        private readonly ShelterId $id,
        private Address $address,
        private string|null $name = null,
        private bool $verified = false,
    ) {
    }

    public function id(): ShelterId
    {
        return $this->id;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function name(): string|null
    {
        return $this->name;
    }

    public function verified(): bool
    {
        return $this->verified;
    }
}
