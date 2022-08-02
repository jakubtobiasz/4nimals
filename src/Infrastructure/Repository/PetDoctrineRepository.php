<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Pet\PetCollectionDto;
use App\Domain\Pet\PetRepository;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;
use Doctrine\DBAL\Query\QueryBuilder;

final class PetDoctrineRepository extends Repository implements PetRepository
{
    public function findAllPaginated(int $page = 1, int $maxResults = 20): PetCollectionDto
    {
        $qb = $this->findAllQueryBuilder();

        $firstPage = ($page - 1) * $maxResults;
        $qb
            ->leftJoin('s', 'pets', 'p', 's.id = p.shelter_id')
            ->groupBy('s.id')
            ->setFirstResult($firstPage)
            ->setMaxResults($maxResults)
        ;

        dd($qb->executeQuery()->fetchAllAssociative());

//        return new PetCollectionDto($qb->executeQuery() ->fetchAllAssociative(), $this->count());
    }

    public function count(): int
    {
        return (int) $this->findAllQueryBuilder()
            ->select('COUNT(*)')
            ->executeQuery()
            ->fetchOne();
    }

    private function findAllQueryBuilder(): QueryBuilder
    {
        return $this->createDbalQueryBuilder()
            ->select('*')
            ->from('shelters', 's')
        ;
    }
}
