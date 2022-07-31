<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\Pagination;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Traversable;

final class Paginator implements PaginatorInterface, \IteratorAggregate
{
    public function __construct(
        private readonly Traversable $items,
        private readonly float $totalItems,
        private readonly float $currentPage,
        private readonly float $itemsPerPage,
    ) {
    }

    public function getIterator(): Traversable
    {
        return $this->items;
    }

    public function count(): int
    {
        return iterator_count($this->items);
    }

    public function getLastPage(): float
    {
        return ceil($this->getTotalItems() / $this->getItemsPerPage());
    }

    public function getTotalItems(): float
    {
        return $this->totalItems;
    }

    public function getCurrentPage(): float
    {
        if ($this->currentPage > $this->getLastPage()) {
            return $this->getLastPage();
        }

        return $this->currentPage;
    }

    public function getItemsPerPage(): float
    {
        return $this->itemsPerPage;
    }
}
