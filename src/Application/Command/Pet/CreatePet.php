<?php

declare(strict_types=1);

namespace App\Application\Command\Pet;

final class CreatePet
{
    public function __construct(
        public string $name,
        public string $shelterId,
    ) {
    }
}
