<?php

declare(strict_types=1);

namespace spec\App\Infrastructure\Security\Provider;

use App\Domain\AdminUser\AdminUserInterface;
use App\SharedKernel\Domain\EntityRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AdminUserProviderSpec extends ObjectBehavior
{
    function let(EntityRepositoryInterface $adminUserRepository)
    {
        $this->beConstructedWith($adminUserRepository);
    }

    function it_is_user_provider()
    {
        $this->shouldImplement(UserProviderInterface::class);
    }

    function it_supports_admin_user_entity()
    {
        $this->supportsClass('App\Domain\Auth\AdminUser')->shouldReturn(true);
    }

    function it_loads_user_by_email(EntityRepositoryInterface $adminUserRepository, AdminUserInterface $adminUser)
    {
        $adminUserRepository->findOneBy(['email' => 'user@example.com'])->shouldBeCalled()->willReturn($adminUser);

        $this->loadUserByUsername('user@example.com')->shouldBeAnInstanceOf(AdminUserInterface::class);
    }

    function it_throws_exception_when_administrator_not_found(EntityRepositoryInterface $adminUserRepository)
    {
        $adminUserRepository->findOneBy(['email' => 'user@example.com'])->shouldBeCalled()->willReturn(null);

        $this
            ->shouldThrow(UserNotFoundException::class)
            ->during('loadUserByUsername', ['user@example.com'])
        ;
    }

    function it_refreshes_user(EntityRepositoryInterface $adminUserRepository, AdminUserInterface $adminUser)
    {
        $adminUser->getUserIdentifier()->shouldBeCalled()->willReturn('user@example.com');

        $adminUserRepository->findOneBy(['email' => 'user@example.com'])->shouldBeCalled()->willReturn($adminUser);

        $this->refreshUser($adminUser)->shouldReturn($adminUser);
    }
}
