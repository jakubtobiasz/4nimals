<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\EventSubscriber;

use App\Domain\AdminUser\AdminUser;
use App\Domain\FrontUser\FrontUser;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

final class UserActivitySubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
            Events::prePersist,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!$object instanceof AdminUser && !$object instanceof FrontUser) {
            return;
        }

        $this->updatePassword($object);
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!$object instanceof AdminUser && !$object instanceof FrontUser) {
            return;
        }

        $this->updatePassword($object);
    }

    private function updatePassword(AdminUser|FrontUser $user): void
    {
        if (null === $user->plainPassword()) {
            return;
        }

        $user->changePassword($user->plainPassword());
        $user->eraseCredentials();
    }
}
