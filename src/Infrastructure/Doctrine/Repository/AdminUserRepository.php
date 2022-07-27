<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\AdminUser\AdminUser;
use App\Domain\AdminUser\AdminUserRepositoryInterface;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class AdminUserRepository extends Repository implements AdminUserRepositoryInterface
{
    public function findOneByEmail(string $email): ?AdminUser
    {
        return $this->getRepository(AdminUser::class)->findOneBy(['email' => $email]);
    }
}
