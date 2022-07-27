<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Command\CreateShelter;
use App\Application\CommandResult\CreateShelterResult;
use App\Domain\Shelter\Factory\ShelterFactory;
use App\Domain\Shelter\ShelterRepositoryInterface;
use App\SharedKernel\Domain\Identifier\Uuid;

final class CreateShelterHandler
{
    public function __construct(
        private readonly ShelterFactory $shelterFactory,
        private readonly ShelterRepositoryInterface $shelterRepository,
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
