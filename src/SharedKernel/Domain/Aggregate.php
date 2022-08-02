<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

use App\SharedKernel\Domain\Event\DomainEvent;

abstract class Aggregate
{
    /**
     * @var array<DomainEvent>
     */
    private array $events = [];

    /**
     * @return array<DomainEvent>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    protected function raise(DomainEvent $event): void
    {

    }
}
