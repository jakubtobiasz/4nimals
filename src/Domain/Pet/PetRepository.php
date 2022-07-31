<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\SharedKernel\Domain\RepositoryInterface;

interface PetRepository extends RepositoryInterface
{
    public function findAllPaginated(int $page, int $maxResults): PetCollectionDto;

    public function count(): int;
}
