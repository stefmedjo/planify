<?php
namespace UserBundle\Security;
 
use UserBundle\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\HttpFoundation\Exception;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserChecker implements UserCheckerInterface{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }
    }
 
    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }
 
        // user account is expired, the user may be notified
        if (!$user->getIsActive()) {
            $e = new AccountExpiredException("Votre compte n'a pas encore été activé.");
            throw $e;
        }

        return $user;
    }
}