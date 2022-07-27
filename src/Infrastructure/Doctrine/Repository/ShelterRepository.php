<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Shelter\Shelter;
use App\Domain\Shelter\ShelterRepositoryInterface;
use App\SharedKernel\Domain\Identifier\Uuid;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class ShelterRepository extends Repository implements ShelterRepositoryInterface
{
    public function find(Uuid $id): Shelter
    {
        return $this->entityManager->find(Shelter::class, $id);
    }
}
