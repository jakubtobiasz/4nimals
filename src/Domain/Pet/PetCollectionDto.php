<?php

declare(strict_types=1);

namespace App\Domain\Pet;

use App\SharedKernel\Domain\Collection;
use App\SharedKernel\Domain\TotalItemsAwareCollectionInterface;

final class PetCollectionDto extends Collection implements TotalItemsAwareCollectionInterface
{
    private int $position = 0;

    public function __construct(
        private readonly array $elements,
        private readonly int $totalItems
    ) {
        parent::__construct($this->elements);
    }

    public function getClass(): string
    {
        return PetDto::class;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }
}
