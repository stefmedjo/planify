<?php

namespace MainBundle\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use MainBundle\Entity\Task;
use MainBundle\Entity\Project;
use UserBundle\Entity\User;

class TaskVoter extends Voter{

    const VIEW = "view";
    const CREATE = "create";
    const EDIT = "edit";
    const DELETE = "delete";

    protected function supports($attribute, $subject){
        if(!in_array($attribute,[self::VIEW,self::CREATE,self::EDIT,self::DELETE])){
            return false;
        }

        if(!$subject instanceof Task){
            return false;
        }

        if(!$subject->getProject() instanceof Project){
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

    private function canCreate(Task $subject, User $user){
        return $subject->getProject()->getCompany() == $user->getCompany();
    }

    private function canEdit(Task $subject, User $user){
        return $subject->getProject()->getCompany() == $user->getCompany();
    }

    private function canView(Task $subject, User $user){
        return $subject->getProject()->getCompany() == $user->getCompany();
    }

    private function canDelete(Task $subject, User $user){
        return $subject->getProject()->getCompany() == $user->getCompany();
    }
}