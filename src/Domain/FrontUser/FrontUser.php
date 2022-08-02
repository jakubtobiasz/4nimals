<?php

declare(strict_types=1);

namespace App\Domain\FrontUser;

use App\SharedKernel\Domain\Identifier\Uuid;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class FrontUser implements PasswordAuthenticatedUserInterface, UserInterface
{
    private Uuid $id;

    private array $roles = [];

    private ?string $password = null;

    private ?string $plainPassword = null;

    public function __construct(private string $email)
    {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function addRole(string $role): void
    {
        if (! in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    public function removeRole(string $role): void
    {
        if (in_array($role, $this->roles, true)) {
            unset($this->roles[array_search($role, $this->roles, true)]);
        }
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }
}
