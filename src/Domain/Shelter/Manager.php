<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

class Manager
{
    public function __construct(
        private readonly ManagerId $id,
        private readonly ShelterId $shelterId,
        private readonly string $firstName,
        private readonly string $lastName,
    ) {
    }
}
