<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Routing;

use ApiPlatform\Core\Bridge\Symfony\Routing\RouteNameResolverInterface;
use ApiPlatform\Core\Cache\CachedTrait;
use App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider\PathPrefixProviderInterface;
use Psr\Cache\CacheItemPoolInterface;
use Webmozart\Assert\Assert;

/**
 * This class is based on src/Bridge/Symfony/Routing/CachedRouteNameResolver.php, but has added logic for matching
 * /shop, /admin prefixes
 */
final class CachedRouteNameResolver implements RouteNameResolverInterface
{
    use CachedTrait;

    public function __construct(
        CacheItemPoolInterface $cacheItemPool,
        private readonly RouteNameResolverInterface $decorated,
        private readonly PathPrefixProviderInterface $pathPrefixProvider
    ) {
        $this->cacheItemPool = $cacheItemPool;
    }

    public function getRouteName(string $resourceClass, $operationType): string
    {
        $currentPrefix = $this->pathPrefixProvider->getCurrentPrefix();
        Assert::notNull($currentPrefix);

        $routeName = sprintf('route_name_%s_', $currentPrefix);

        $context = \func_num_args() > 2 ? func_get_arg(2) : [];

        $cacheKey = $routeName . md5(
            serialize([$resourceClass, $operationType, $context['subresource_resources'] ?? null])
        );

        return $this->getCached($cacheKey, function () use ($resourceClass, $operationType, $context) {
            /** @psalm-suppress TooManyArguments */
            return $this->decorated->getRouteName($resourceClass, $operationType, $context);
        });
    }
}
