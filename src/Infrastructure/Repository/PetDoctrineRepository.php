<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Pet\PetRepository;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class PetDoctrineRepository extends Repository implements PetRepository
{
}
