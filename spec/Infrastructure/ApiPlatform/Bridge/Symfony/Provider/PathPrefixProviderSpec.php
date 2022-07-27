<?php

declare(strict_types=1);

namespace spec\App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider;

use App\Domain\AdminUser\AdminUser;
use App\Domain\User\UserInterface;
use App\Infrastructure\ApiPlatform\Bridge\Symfony\Provider\PathPrefixProviderInterface;
use App\Infrastructure\Context\UserContextInterface;
use PhpSpec\ObjectBehavior;

class PathPrefixProviderSpec extends ObjectBehavior
{
    function let(UserContextInterface $userContext)
    {
        $this->beConstructedWith($userContext, '/api');
    }

    function it_is_path_prefix_provider()
    {
        $this->shouldImplement(PathPrefixProviderInterface::class);
    }

    function it_returns_null_when_passed_path_doesnt_contain_api_prefix()
    {
        $this->getPathPrefix('/')->shouldReturn(null);
    }

    function it_returns_front_when_passed_path_contains_front_string()
    {
        $this->getPathPrefix('/api/front/')->shouldReturn('front');
    }

    function it_returns_admin_when_passed_path_contains_admin_string()
    {
        $this->getPathPrefix('/api/admin/')->shouldReturn('admin');
    }

    function it_returns_null_when_passed_path_doesnt_contain_whether_admin_nor_front_string()
    {
        $this->getPathPrefix('/api/random/')->shouldReturn(null);
    }

    function it_returns_front_as_current_prefix_when_user_is_null(UserContextInterface $userContext)
    {
        $userContext->getUser()->willReturn(null);

        $this->getCurrentPrefix()->shouldReturn('front');
    }

    function it_returns_front_as_current_prefix_when_user_is_regular_user(
        UserContextInterface $userContext,
        UserInterface $user
    ) {
        $userContext->getUser()->willReturn($user);

        $this->getCurrentPrefix()->shouldReturn('front');
    }

    function it_returns_admin_as_current_prefix_when_user_is_admin_user(
        UserContextInterface $userContext,
        AdminUser $user
    ) {
        $userContext->getUser()->willReturn($user);

        $this->getCurrentPrefix()->shouldReturn('admin');
    }
}
