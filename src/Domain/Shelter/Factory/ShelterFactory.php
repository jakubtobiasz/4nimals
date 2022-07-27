<?php

declare(strict_types=1);

namespace App\Domain\Shelter\Factory;

use App\Domain\Shelter\Shelter;
use App\SharedKernel\Domain\Address;
use App\SharedKernel\Domain\Identifier\Uuid;

class ShelterFactory
{
    public function createNew(Uuid $uuid, string $name, Address $address): Shelter
    {
        return new Shelter($uuid, $name, $address);
    }
}
