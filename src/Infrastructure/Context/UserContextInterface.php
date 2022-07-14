<?php

declare(strict_types=1);

namespace App\Infrastructure\Context;

use Symfony\Component\Security\Core\User\UserInterface;

interface UserContextInterface
{
    public function getUser(): ?UserInterface;
}
