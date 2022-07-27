<?php

declare(strict_types=1);

namespace App\Domain\AdminUser;

use App\SharedKernel\Domain\RepositoryInterface;

interface AdminUserRepositoryInterface extends RepositoryInterface
{
    public function findOneByEmail(string $email): ?AdminUser;
}
