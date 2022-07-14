<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\SharedKernel\Domain\EntityRepositoryInterface;
use App\SharedKernel\Domain\ResourceInterface;
use Doctrine\ORM\EntityRepository as BaseEntityRepository;

class EntityRepository extends BaseEntityRepository implements EntityRepositoryInterface
{
    public function add(ResourceInterface $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(ResourceInterface $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
