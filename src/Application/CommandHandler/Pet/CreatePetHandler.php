<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Pet;

use App\Application\Command\Pet\CreatePet;
use App\Application\CommandResult\Pet\CreatePetResult;
use App\Domain\Pet\PetFactory;
use App\Domain\Pet\PetRepository;
use App\SharedKernel\Domain\Identifier\PetId;

final class CreatePetHandler
{
    public function __construct(
        private readonly PetFactory $petFactory,
        private readonly PetRepository $petRepository
    ) {
    }

    public function __invoke(CreatePet $command): CreatePetResult
    {
        $uuid = PetId::create();
        $shelterId = PetId::fromString($command->shelterId);

        $pet = $this->petFactory->createNew($uuid, $shelterId, $command->name);

        $this->petRepository->persist($pet);

        return new CreatePetResult(strval($uuid));
    }
}
