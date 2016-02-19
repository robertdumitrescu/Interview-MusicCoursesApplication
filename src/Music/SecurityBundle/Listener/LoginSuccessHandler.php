<?php

namespace Music\SecurityBundle\Listener;

use Music\SecurityBundle\Controller\SecurityController;
use Music\SecurityBundle\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        /** @var User $user */
        $user = $token->getUser();
        return new JsonResponse([
            SecurityController::STATUS_CODE => 1,
            'username' => $user->getUsername(),
        ]);
    }
}