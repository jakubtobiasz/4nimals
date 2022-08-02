<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Address;

class Shelter
{
    public function __construct(
        private readonly ShelterId $id,
        private string $name,
        private Address $address,
        private bool $verified = false,
    ) {
    }
}
