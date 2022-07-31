<?php

declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\Doctrine\Repository;

use App\SharedKernel\Domain\RepositoryInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class Repository implements RepositoryInterface
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager
    ) {
    }

    public function persist(object $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function getRepository(string $className): ObjectRepository
    {
        return $this->entityManager->getRepository($className);
    }

    public function createDbalQueryBuilder(): QueryBuilder
    {
        return $this->entityManager->getConnection()->createQueryBuilder();
    }
}
