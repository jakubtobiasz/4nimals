<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Routing;

use ApiPlatform\Core\Api\OperationType;
use ApiPlatform\Core\Bridge\Symfony\Routing\RouteNameResolverInterface;
use ApiPlatform\Core\Exception\InvalidArgumentException;
use App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider\PathPrefixProviderInterface;
use Symfony\Component\Routing\RouterInterface;
use Webmozart\Assert\Assert;

/**
 * This class is based on src/Bridge/Symfony/Routing/RouteNameResolver.php, but has added logic for matching /shop, /admin prefixes
 */
final class RouteNameResolver implements RouteNameResolverInterface
{
    public function __construct(
        private readonly RouterInterface $router,
        private readonly PathPrefixProviderInterface $pathPrefixProvider
    ) {
    }

    public function getRouteName(string $resourceClass, $operationType): string
    {
        $operationType = strval($operationType);
        $context = \func_num_args() > 2 ? func_get_arg(2) : [];

        $matchingRoutes = [];

        foreach ($this->router->getRouteCollection()->all() as $routeName => $route) {
            $currentResourceClass = $route->getDefault('_api_resource_class');
            $operation = $route->getDefault(sprintf('_api_%s_operation_name', $operationType));
            $methods = $route->getMethods();

            if (
                $resourceClass === $currentResourceClass &&
                null !== $operation &&
                (empty($methods) || \in_array('GET', $methods, true))
            ) {
                if (
                    OperationType::SUBRESOURCE === $operationType &&
                    false === $this->isSameSubresource($context, $route->getDefault('_api_subresource_context'))) {
                    continue;
                }

                $matchingRoutes[$routeName] = $route;
            }
        }

        return $this->returnMatchingRouteName($matchingRoutes, $operationType, $resourceClass);
    }

    private function isSameSubresource(array $context, array $currentContext): bool
    {
        $subresources = array_keys($context['subresource_resources']);
        $currentSubresources = [];

        foreach ($currentContext['identifiers'] as [$class]) {
            $currentSubresources[] = $class;
        }

        return $currentSubresources === $subresources;
    }

    private function returnMatchingRouteName(
        array $matchingRoutes,
        string $operationType,
        string $resourceClass
    ): string {
        if (count($matchingRoutes) === 1) {
            return array_key_first($matchingRoutes);
        }

        foreach ($matchingRoutes as $routeName => $route) {
            $routePrefix = $this->pathPrefixProvider->getPathPrefix($route->getPath());
            if ($routePrefix === null) {
                return $routeName;
            }

            $requestPrefix = $this->pathPrefixProvider->getCurrentPrefix();
            if ($requestPrefix === $routePrefix) {
                return $routeName;
            }
        }

        throw new InvalidArgumentException(
            sprintf('No %s route associated with the type "%s".', $operationType, $resourceClass)
        );
    }
}
