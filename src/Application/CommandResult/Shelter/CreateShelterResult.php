<?php

declare(strict_types=1);

namespace App\Application\CommandResult\Shelter;

final class CreateShelterResult
{
    public function __construct(
        public readonly string $id,
    ) {
    }
}
