<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider;

use App\Domain\AdminUser\AdminUser;
use App\Domain\FrontUser\FrontUser;
use App\Infrastructure\Context\UserContextInterface;

final class PathPrefixProvider implements PathPrefixProviderInterface
{
    public function __construct(
        private readonly UserContextInterface $userContext,
        private readonly string $apiRoute
    ) {
    }

    public function getPathPrefix(string $path): ?string
    {
        if (! str_contains($path, $this->apiRoute)) {
            return null;
        }

        $pathElements = array_values(array_filter(explode('/', str_replace($this->apiRoute, '', $path))));

        if ($pathElements[0] === PathPrefixes::FRONT->value) {
            return PathPrefixes::FRONT->value;
        }

        if ($pathElements[0] === PathPrefixes::ADMIN->value) {
            return PathPrefixes::ADMIN->value;
        }

        return null;
    }

    public function getCurrentPrefix(): ?string
    {
        $user = $this->userContext->getUser();

        if ($user === null || $user instanceof FrontUser) {
            return PathPrefixes::FRONT->value;
        }

        if ($user instanceof AdminUser) {
            return PathPrefixes::ADMIN->value;
        }

        return null;
    }
}
