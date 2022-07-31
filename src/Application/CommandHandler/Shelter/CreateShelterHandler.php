<?php

declare(strict_types=1);

namespace App\Application\CommandHandler\Shelter;

use App\Application\Command\Shelter\CreateShelter;
use App\Application\CommandResult\Shelter\CreateShelterResult;
use App\Domain\Shelter\ShelterFactory;
use App\Domain\Shelter\ShelterRepository;
use App\SharedKernel\Domain\Identifier\Uuid;

final class CreateShelterHandler
{
    public function __construct(
        private readonly ShelterFactory $shelterFactory,
        private readonly ShelterRepository $shelterRepository,
    ) {
    }

    public function __invoke(CreateShelter $command): CreateShelterResult
    {
        $uuid = Uuid::create();

        $shelter = $this->shelterFactory->createNew(
            $uuid,
            $command->name,
            $command->address
        );

        $this->shelterRepository->persist($shelter);

        return new CreateShelterResult(strval($uuid));
    }
}
