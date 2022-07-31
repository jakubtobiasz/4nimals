<?php

declare(strict_types=1);

namespace App\Application\CommandResult\Pet;

final class CreatePetResult
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
