<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain;


use App\SharedKernel\Domain\Identifier\Uuid;

interface ResourceInterface
{
    public function getId(): ?int;

    public function getUuid(): ?Uuid;
}
