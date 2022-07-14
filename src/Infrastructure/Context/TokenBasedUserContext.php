<?php

declare(strict_types=1);

namespace App\Infrastructure\Context;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class TokenBasedUserContext implements UserContextInterface
{
    public function __construct(
        private readonly TokenStorageInterface $tokenStorage
    ) {
    }

    public function getUser(): ?UserInterface
    {
        $token = $this->tokenStorage->getToken();
        if ($token === null) {
            return null;
        }

        /** @var UserInterface|string $user */
        $user = $token->getUser();
        if (is_string($user)) {
            return null;
        }

        return $user;
    }
}
