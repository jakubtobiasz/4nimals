<?php

declare(strict_types=1);

namespace spec\App\Domain\Shelter\Factory;

use App\Domain\Shelter\ShelterInterface;
use App\SharedKernel\Domain\Factory\FactoryInterface;
use PhpSpec\ObjectBehavior;

class ShelterFactorySpec extends ObjectBehavior
{
    function it_is_factory()
    {
        $this->shouldImplement(FactoryInterface::class);
    }

    function it_create_new_shelter_instance()
    {
        $resource = $this->createNew();

        $resource->shouldBeAnInstanceOf(ShelterInterface::class);
    }
}
