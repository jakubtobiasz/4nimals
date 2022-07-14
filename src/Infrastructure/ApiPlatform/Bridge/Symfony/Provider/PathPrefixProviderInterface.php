<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider;

interface PathPrefixProviderInterface
{
    public function getPathPrefix(string $path): ?string;

    public function getCurrentPrefix(): ?string;
}
