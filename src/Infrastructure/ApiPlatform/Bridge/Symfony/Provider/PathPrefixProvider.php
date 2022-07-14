<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider;

use App\Domain\AdminUser\AdminUserInterface;
use App\Infrastructure\Context\UserContextInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class PathPrefixProvider implements PathPrefixProviderInterface
{
    public function __construct(
        private readonly UserContextInterface $userContext,
        private readonly string $apiRoute
    ) {
    }

    public function getPathPrefix(string $path): ?string
    {
        if (!str_contains($path, $this->apiRoute)) {
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
        /** @var UserInterface|null $user */
        $user = $this->userContext->getUser();

        if ($user === null || $user instanceof \App\Domain\User\UserInterface) {
            return PathPrefixes::FRONT->value;
        }

        if ($user instanceof AdminUserInterface) {
            return PathPrefixes::ADMIN->value;
        }

        return null;
    }
}
