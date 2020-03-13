<?php

namespace MainBundle\Validator;

use MainBundle\Entity\Category;

class CategoryValidator{
    
    public static function isValid(Category $category){
        $success = false;
        $message = "";
        if(count($category->getName()) == 0){
            $message = "Vous devez fournir une désignation";
        }else{
            $success = true;
        }
        return ["success" => $success, "message" => $message];
    }

}