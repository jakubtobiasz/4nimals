<?php

declare(strict_types=1);

namespace App\Domain\Shelter;

use App\SharedKernel\Domain\Collection;

final class ManagerCollection extends Collection
{
    public function getClass(): string
    {
        return Manager::class;
    }
}
