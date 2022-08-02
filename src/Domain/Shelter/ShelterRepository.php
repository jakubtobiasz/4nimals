<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Identifier\PetId;
use App\SharedKernel\Domain\RepositoryInterface;

interface ShelterRepository extends RepositoryInterface
{
    public function find(PetId $id): Shelter;
}
