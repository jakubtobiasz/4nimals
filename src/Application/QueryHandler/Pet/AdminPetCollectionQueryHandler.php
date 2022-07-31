<?php

declare(strict_types=1);

namespace App\Application\QueryHandler\Pet;

use App\Application\Query\Pet\AdminPetCollectionQuery;
use App\Domain\Pet\PetCollectionDto;
use App\Domain\Pet\PetRepository;

final class AdminPetCollectionQueryHandler
{
    public function __construct(
        private readonly PetRepository $petRepository,
    ) {
    }

    public function __invoke(AdminPetCollectionQuery $query): PetCollectionDto
    {
        return $this->petRepository->findAllPaginated($query->page, $query->itemsPerPage);
    }
}
