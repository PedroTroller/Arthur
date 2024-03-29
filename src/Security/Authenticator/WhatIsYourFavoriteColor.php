<?php

declare(strict_types=1);

namespace App\Security\Authenticator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

final class WhatIsYourFavoriteColor extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return $request->query->has('color');
    }

    public function getCredentials(Request $request)
    {
        return [
            'color' => $request->query->get('color'),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['color']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(
        Request $request,
        AuthenticationException $exception
    ): void {
    }

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        $providerKey
    ): void {
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(
        Request $request,
        AuthenticationException $authException = null
    ) {
        return new Response('Nein !', 401);
    }
}
