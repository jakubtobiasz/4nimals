<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Identifier\Uuid;
use App\SharedKernel\Domain\RepositoryInterface;

interface ShelterRepositoryInterface extends RepositoryInterface
{
    public function find(Uuid $id): Shelter;
}
