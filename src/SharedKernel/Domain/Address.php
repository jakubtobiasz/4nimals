<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

class Address
{
    public function __construct(
        public readonly string $street,
        public readonly int $buildingNumber,
        public readonly string $city,
        public readonly string $zipCode,
    ) {
    }
}
