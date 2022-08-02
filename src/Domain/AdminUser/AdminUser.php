<?php

declare(strict_types=1);

namespace App\Domain\AdminUser;

use App\Domain\AdminUser\Event\AdminUserPasswordChanged;
use App\SharedKernel\Domain\Aggregate;
use App\SharedKernel\Domain\UserMethods;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @property array<string> $roles
 */
class AdminUser extends Aggregate implements PasswordAuthenticatedUserInterface, UserInterface
{
    use UserMethods;

    public function __construct(
        private readonly AdminUserId $id,
        private string|null $email = null,
        private string|null $password = null,
        private array $roles = [],
    ) {
    }

    public function id(): AdminUserId
    {
        return $this->id;
    }

    public function email(): string|null
    {
        return $this->email;
    }

    /**
     * @return array<string>
     */
    public function roles(): array
    {
        $this->roles[] = 'ROLE_ADMIN';
        $this->roles[] = 'ROLE_USER';

        return array_unique($this->roles);
    }

    public function password(): string|null
    {
        return $this->password;
    }

    public function changePassword(string $newPassword): void
    {
        $this->password = $newPassword;

        $this->raise(new AdminUserPasswordChanged());
    }
}
