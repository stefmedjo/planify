<?php

namespace UserBundle\Utils;

use UserBundle\Entity\User;

class UserUtils{
    
    public static function isValidUser(User $user,$role){
        if(in_array($role,$user->getRoles())){
            if(filter_var($user->getEmail(),FILTER_VALIDATE_EMAIL) == false){
                return ["success" => false, "message" => "Email non valide."];
            }else{
                return ["success" => true, "message" => ""];    
            }
        }else{
            return ["success" => false, "message" => "Problème de rôle."];
        }
    }
    
    public static function isValidCompanyUser(\Symfony\Component\Form\FormInterface $form){
        $success = false;
        $msg = "";
        if(filter_var($form->get("email"),FILTER_VALIDATE_EMAIL) == false){
            
        }else if(count($form->get("company")) == 0){
            
        }
        return ["success" => $success, "message" => $msg];
    }
    
}