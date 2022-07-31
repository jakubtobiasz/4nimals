<?php

declare(strict_types=1);

namespace App\Application\Query\Pet;

final class AdminPetCollectionQuery
{
    public function __construct(
        public readonly int $page,
        public readonly int $itemsPerPage,
    ) {
    }
}
