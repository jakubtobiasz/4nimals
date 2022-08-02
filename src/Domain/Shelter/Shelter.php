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
        private ManagerIdCollection $managers,
        private bool $verified = false,
    ) {
    }
}
