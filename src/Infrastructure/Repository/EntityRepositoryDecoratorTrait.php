<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

trait EntityRepositoryDecoratorTrait
{
    private EntityRepositoryInterface $decoratedRepository;

    public function find($id): ?object
    {
        return $this->decoratedRepository->find($id);
    }

    public function findAll(): array
    {
        return $this->decoratedRepository->findAll();
    }

    /**
     * @return object[]
     */
    public function findBy(
        array $criteria,
        ?array $orderBy = null,
        $limit = null,
        $offset = null
    ): array {
        return $this->decoratedRepository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria): ?object
    {
        return $this->decoratedRepository->findOneBy($criteria);
    }

    public function getClassName(): string
    {
        return $this->decoratedRepository->getClassName();
    }

    private function createQueryBuilder(string $alias, ?string $indexBy = null): QueryBuilder
    {
        /** @phpstan-ignore-next-line */
        return $this->decoratedRepository->createQueryBuilder($alias, $indexBy);
    }

    public function add(ResourceInterface $resource): void
    {
        $this->decoratedRepository->add($resource);
    }

    public function remove(ResourceInterface $resource): void
    {
        $this->decoratedRepository->remove($resource);
    }
}
