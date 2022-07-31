<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider;

enum PathPrefixes: string
{
    case ADMIN = 'admin';
    case FRONT = 'front';
}
