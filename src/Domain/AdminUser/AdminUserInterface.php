<?php

declare(strict_types=1);

namespace App\Domain\AdminUser;


use App\SharedKernel\Domain\ResourceInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface AdminUserInterface extends ResourceInterface, UserInterface
{
}
