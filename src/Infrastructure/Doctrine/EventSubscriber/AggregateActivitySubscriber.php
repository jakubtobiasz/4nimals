<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\EventSubscriber;

use App\SharedKernel\Domain\Aggregate;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AggregateActivitySubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postFlush,
        ];
    }

    public function postFlush(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!$object instanceof Aggregate) {
            return;
        }

        $this->publishEvents($object);
    }

    private function publishEvents(Aggregate $aggregate): void
    {
        foreach ($aggregate->getEvents() as $event) {
            $this->eventDispatcher->dispatch($event);
        }
    }
}
