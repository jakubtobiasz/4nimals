<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\EventSubscriber;

use App\Domain\AdminUser\AdminUser;
use App\Domain\FrontUser\FrontUser;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserActivitySubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

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

        $user->changePassword(
            $this->passwordHasher->hashPassword($user, $user->plainPassword())
        );
        $user->eraseCredentials();
    }
}
