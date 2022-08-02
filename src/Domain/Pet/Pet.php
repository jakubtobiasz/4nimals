<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\Domain\Shelter\ShelterId;
use App\SharedKernel\Domain\Aggregate;

class Pet extends Aggregate
{
    public function __construct(
        private readonly PetId $id,
        private ShelterId $shelterId,
        private string|null $name = null,
        private bool $adopted = false,
    ) {
    }

    public function id(): PetId
    {
        return $this->id;
    }

    public function shelterId(): ShelterId
    {
        return $this->shelterId;
    }

    public function name(): string|null
    {
        return $this->name;
    }

    public function adopted(): bool
    {
        return $this->adopted;
    }
}
