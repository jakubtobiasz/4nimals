<?php

declare(strict_types=1);

namespace App\Infrastructure\Security\Provider;

use App\Domain\AdminUser\AdminUserInterface;
use App\SharedKernel\Domain\EntityRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class AdminUserProvider implements UserProviderInterface
{
    public function __construct(private readonly EntityRepositoryInterface $adminUserRepository)
    {
    }

    public function refreshUser(UserInterface $user): AdminUserInterface
    {
        return $this->loadUserByUsername($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return is_a($class, AdminUserInterface::class, true);
    }

    public function loadUserByUsername(string $username): AdminUserInterface
    {
        /** @var AdminUserInterface|null $adminUser */
        $adminUser = $this->adminUserRepository->findOneBy(['email' => $username]);

        if (null === $adminUser) {
            throw new UserNotFoundException(sprintf('Administrator with email "%s" not found.', $username));
        }

        return $adminUser;
    }
}
