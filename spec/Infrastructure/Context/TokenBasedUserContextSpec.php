<?php

declare(strict_types=1);

namespace spec\App\Infrastructure\Context;

use App\Infrastructure\Context\UserContextInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class TokenBasedUserContextSpec extends ObjectBehavior
{
    function let(TokenStorageInterface $tokenStorage)
    {
        $this->beConstructedWith($tokenStorage);
    }

    function it_is_user_context()
    {
        $this->shouldImplement(UserContextInterface::class);
    }

    function it_returns_null_when_token_is_null(TokenStorageInterface $tokenStorage) {
        $tokenStorage->getToken()->willReturn(null);

        $this->getUser()->shouldBe(null);
    }

    function it_returns_null_when_user_is_string(
        TokenStorageInterface $tokenStorage,
        TokenInterface $token
    ) {
        $token->getUser()->willReturn('some_string');

        $tokenStorage->getToken()->willReturn($token);

        $this->getUser()->shouldBe(null);
    }

    function it_returns_user(
        TokenStorageInterface $tokenStorage,
        TokenInterface $token,
        UserInterface $user
    ) {
        $token->getUser()->willReturn($user);

        $tokenStorage->getToken()->willReturn($token);

        $this->getUser()->shouldBe($user);
    }
}
