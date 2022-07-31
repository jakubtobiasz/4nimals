<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Identifier\Uuid;

class Manager
{
    public function __construct(
        private readonly Uuid $id,
        private readonly Uuid $shelterId,
        private readonly string $firstName,
        private readonly string $lastName,
    ) {
    }
}
