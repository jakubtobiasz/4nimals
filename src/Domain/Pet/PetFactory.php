<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\SharedKernel\Domain\Identifier\Uuid;

final class PetFactory
{
    public function createNew(Uuid $id, Uuid $shelterId, string $name): Pet
    {
        return new Pet($id, $shelterId, $name);
    }
}
