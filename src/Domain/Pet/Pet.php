<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\Domain\Shelter\ShelterId;
use App\SharedKernel\Domain\Identifier\PetId;

class Pet
{
    public function __construct(
        private PetId $id,
        private ShelterId $shelterId,
        private string $name,
        private bool $adopted = false,
    ) {
    }

    public function getId(): PetId
    {
        return $this->id;
    }

    public function getShelterId(): PetId
    {
        return $this->shelterId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function isAdopted(): bool
    {
        return $this->adopted;
    }

    public function setAdopted(bool $adopted): void
    {
        $this->adopted = $adopted;
    }
}
