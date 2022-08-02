<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

interface TotalItemsAwareCollectionInterface
{
    public function getTotalItems(): int;
}
