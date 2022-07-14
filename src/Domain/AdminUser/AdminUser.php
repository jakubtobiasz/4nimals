<?php

declare(strict_types=1);

namespace App\Domain\AdminUser;

use App\SharedKernel\Domain\Identifier\Uuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class AdminUser implements AdminUserInterface
{
    private ?int $id = null;

    private Uuid $uuid;

    private Collection $roles;

    private ?string $password = null;

    private ?string $plainPassword = null;

    public function __construct(private string $email)
    {
        $this->uuid = Uuid::create();
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): Collection
    {
        if (!$this->roles->contains('ROLE_USER')) {
            $this->roles->add('ROLE_USER');
        }

        if (!$this->roles->contains('ROLE_ADMIN')) {
            $this->roles->add('ROLE_ADMIN');
        }

        return $this->roles;
    }

    public function addRole(string $role): void
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }
    }

    public function removeRole(string $role): void
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
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
