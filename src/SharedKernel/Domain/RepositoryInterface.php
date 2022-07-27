<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

interface RepositoryInterface
{
    public function persist(object $entity): void;
}
