<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\FrontUser\FrontUser;
use App\Domain\FrontUser\FrontUserRepository;
use App\SharedKernel\Infrastructure\Doctrine\Repository\Repository;

final class FrontUserDoctrineRepository extends Repository implements FrontUserRepository
{
    public function findOneByEmail(string $email): ?FrontUser
    {
        return $this->getRepository(FrontUser::class)->findOneBy([
            'email' => $email,
        ]);
    }
}
