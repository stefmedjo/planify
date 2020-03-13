<?php

namespace MainBundle\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use MainBundle\Entity\Project;
use UserBundle\Entity\User;


class ProjectVoter extends Voter{

    const VIEW = "view";
    const CREATE = "create";
    const EDIT = "edit";
    const DELETE = "delete";

    protected function supports($attribute, $subject){
        if(!in_array($attribute,[self::VIEW,self::CREATE,self::EDIT,self::DELETE])){
            return false;
        }

        if(!$subject instanceof Project){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token){
        $user = $token->getUser();
        if(!$user instanceof User){
            return false;
        }
        
        switch($attribute){
            case self::VIEW:
                return $this->canView($subject,$user);
            case self::CREATE:
                return $this->canCreate($subject,$user);
            case self::EDIT:
                return $this->canEdit($subject,$user);
            case self::DELETE:
                return $this->canDelete($subject,$user);
        }
    }

    private function canCreate(Project $subject, User $user){
        return $subject->getCompany() == $user->getCompany();
    }

    private function canEdit(Project $subject, User $user){
        return $subject->getCompany() == $user->getCompany();
    }

    private function canView(Project $subject, User $user){
        return $subject->getCompany() == $user->getCompany();
    }

    private function canDelete(Project $subject, User $user){
        return $subject->getCompany() == $user->getCompany();
    }
}