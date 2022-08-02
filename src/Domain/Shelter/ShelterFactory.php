<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Address;
use App\SharedKernel\Domain\Identifier\PetId;

class ShelterFactory
{
    public function createNew(PetId $uuid, string $name, Address $address): Shelter
    {
        return new Shelter($uuid, $name, $address);
    }
}
