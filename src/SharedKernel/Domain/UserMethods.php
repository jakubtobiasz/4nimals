<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

/**
 * @property string|null $plainPassword
 *
 * @method string email()
 * @method array<string> roles()
 * @method string|null password()
 */
trait UserMethods
{
    private string|null $plainPassword = null;

    public function plainPassword(): string|null
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPassword(): string|null
    {
        return $this->password();
    }

    public function getRoles(): array
    {
        return $this->roles();
    }

    public function getSalt(): string|null
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getUsername(): string
    {
        return $this->email();
    }

    public function getUserIdentifier(): string
    {
        return $this->email();
    }
}
