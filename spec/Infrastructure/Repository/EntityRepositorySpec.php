<?php

declare(strict_types=1);

namespace spec\App\Infrastructure\Repository;

use App\Infrastructure\Repository\EntityRepository;
use App\SharedKernel\Domain\EntityRepositoryInterface;
use App\SharedKernel\Domain\ResourceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class EntityRepositorySpec extends ObjectBehavior
{
    function let(EntityManagerInterface $entityManager, ClassMetadata $classMetadata)
    {
        $this->beConstructedWith($entityManager, $classMetadata);
    }

    function it_is_entity_repository()
    {
        $this->shouldHaveType(\Doctrine\ORM\EntityRepository::class);
        $this->shouldHaveType(EntityRepositoryInterface::class);
    }

    function it_adds_object(EntityManagerInterface $entityManager, ResourceInterface $resource)
    {
        $entityManager->persist($resource)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->add($resource);
    }

    function it_removes_object(EntityManagerInterface $entityManager, ResourceInterface $resource)
    {
        $entityManager->remove($resource)->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $this->remove($resource);
    }
}
