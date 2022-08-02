<?php

declare(strict_types=1);

namespace App\Domain\FrontUser;

use App\SharedKernel\Domain\RepositoryInterface;

interface FrontUserRepository extends RepositoryInterface
{
    public function findOneByEmail(string $email): ?FrontUser;
}
