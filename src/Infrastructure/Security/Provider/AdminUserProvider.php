<?php

declare(strict_types=1);

namespace App\Infrastructure\Security\Provider;

use App\Domain\AdminUser\AdminUser;
use App\Infrastructure\Doctrine\Repository\AdminUserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class AdminUserProvider implements UserProviderInterface
{
    public function __construct(private readonly AdminUserRepository $adminUserRepository)
    {
    }

    public function refreshUser(UserInterface $user): AdminUser
    {
        return $this->loadUserByUsername($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return is_a($class, AdminUser::class, true);
    }

    public function loadUserByUsername(string $username): AdminUser
    {
        /** @var AdminUser|null $adminUser */
        $adminUser = $this->adminUserRepository->findOneByEmail($username);

        if (null === $adminUser) {
            throw new UserNotFoundException(sprintf('Administrator with email "%s" not found.', $username));
        }

        return $adminUser;
    }
}
