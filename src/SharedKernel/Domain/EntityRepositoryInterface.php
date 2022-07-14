<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;

use Doctrine\Persistence\ObjectRepository;

interface EntityRepositoryInterface extends ObjectRepository
{
    public function add(ResourceInterface $entity): void;

    public function remove(ResourceInterface $entity): void;
}
