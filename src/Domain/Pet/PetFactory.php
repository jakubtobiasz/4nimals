<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\Domain\Shelter\ShelterId;

final class PetFactory
{
    public function createNew( $id, ShelterId $shelterId, string $name): Pet
    {
        return new Pet($id, $shelterId, $name);
    }
}
