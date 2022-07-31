<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\AdminUser\AdminUser;
use App\Domain\AdminUser\AdminUserRepository;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class AdminUserDoctrineRepository extends Repository implements AdminUserRepository
{
    public function findOneByEmail(string $email): ?AdminUser
    {
        return $this->getRepository(AdminUser::class)->findOneBy(['email' => $email]);
    }
}
