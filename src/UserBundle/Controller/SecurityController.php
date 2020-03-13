<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use MainBundle\Entity\Company;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class SecurityController extends Controller{

    /**
     * @Route("login", name="login")
     */
    public function loginAction(Request $request){
        
        $authenticationUtils= $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render("@User/security/login.html.twig",array(
            "last_username" => $lastUsername,
            "error" => $error
        ));
    }

    /**
     * @Route("register", name="register")
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            
            
            $user->setUsername($user->getEmail());
            $password = $this->get("security.password_encoder")->encodePassword($user,$user->getPlainPassword());

            $user->setPassword($password);
            $user->setRoles(['ROLE_ADMIN']);

            $company = new Company();
            $company->setName($user->getCompanyName());
            $user->setCompany($company);


            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("home");
        }
        
        return $this->render("@User/security/register.html.twig",[
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("logout", name="logout")
     */
    public function logoutAction(){

    }


}