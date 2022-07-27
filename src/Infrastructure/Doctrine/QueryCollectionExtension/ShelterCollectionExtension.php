<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\QueryCollectionExtension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Domain\Shelter\Shelter;
use Doctrine\ORM\QueryBuilder;

final class ShelterCollectionExtension implements QueryCollectionExtensionInterface
{
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ): void {
        if (!is_a($resourceClass, Shelter::class, true) || $operationName !== 'front_get') {
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->andWhere(sprintf('%s.verified = :verified', $rootAlias))
            ->setParameter('verified', true)
        ;
    }
}
