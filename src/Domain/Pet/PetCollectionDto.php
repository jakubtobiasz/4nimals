<?php

declare(strict_types=1);

namespace App\Domain\Pet;

final class PetCollectionDto implements \Iterator
{
    private int $position = 0;

    public function __construct(
        private readonly array $elements,
        private readonly int $totalItems
    ) {
    }

    public function current(): PetDto
    {
        return new PetDto($this->elements[$this->position]);
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->elements[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }
}
