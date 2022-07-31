<?php

declare(strict_types=1);

namespace App\Domain\Pet;

final class PetDto
{
    public readonly string $id;

    public readonly string $name;

    public readonly string $shelterId;

    public readonly bool $adopted;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->shelterId = $data['shelter_id'];
        $this->adopted = boolval($data['adopted']);
    }
}
