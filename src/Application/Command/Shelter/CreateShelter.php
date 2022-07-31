<?php

declare(strict_types=1);

namespace App\Application\Command\Shelter;

use App\SharedKernel\Domain\Address;

final class CreateShelter
{
    public function __construct(
        public readonly string $name,
        public readonly Address $address
    ) {
    }
}
