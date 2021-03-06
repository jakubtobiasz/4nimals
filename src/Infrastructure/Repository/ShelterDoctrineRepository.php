<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Shelter\Shelter;
use App\Domain\Shelter\ShelterRepository;
use App\SharedKernel\Domain\Identifier\Uuid;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class ShelterDoctrineRepository extends Repository implements ShelterRepository
{
    public function find(Uuid $id): Shelter
    {
        return $this->entityManager->find(Shelter::class, $id);
    }
}
