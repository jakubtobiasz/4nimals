<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

use Iterator;

/**
 * @template T
 */
abstract class Collection implements Iterator
{
    private int $position = 0;

    public function __construct(
        private array $elements,
    ) {
    }

    abstract public function getClass(): string;

    /**
     * @return T
     */
    public function current(): object
    {
        $class = $this->getClass();
        return new $class($this->elements[$this->position]);
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

    /**
     * @param T $value
     * @return void
     */
    public function append(object $value): void
    {
        $this->elements[] = $value;
    }
}
