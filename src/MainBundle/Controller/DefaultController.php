<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller{

    /**
     * @Route("", name="home")
     */
    public function indexAction(Request $request){
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $all = count($em->getRepository("MainBundle:Project")->findBy(['company'=> $user->getCompany()]));
            $current = count($em->getRepository("MainBundle:Project")->findBy(['company'=> $user->getCompany(),'isClosed' => false]));
            return $this->render("@Main/default/dashboard.html.twig",['all' => $all, 'current' => $current]);
        }else{
            return $this->render("@Main/default/index.html.twig");
        }
    }

    /**
     * @Route("about", name="about")
     */
    public function aboutAction(Request $request){
        return $this->render("@Main/default/about.html.twig");
    }

}