<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\QueryItemExtension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Domain\Shelter\Shelter;
use Doctrine\ORM\QueryBuilder;

final class ShelterItemExtension implements QueryItemExtensionInterface
{
    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        string $operationName = null,
        array $context = []
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
