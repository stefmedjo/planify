<?php

namespace MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use MainBundle\Entity\Link;

class LinkController extends Controller{


    /**
     * @Route("api/links", name="link_api_create", methods={"POST"})
     */
    public function createAction(Request $request){
        $l = $request->request->get('link');
        $source = $l['source'];
        $type = $l['type'];
        $target = $l['target'];
        $project = $l['project'];


        $em = $this->getDoctrine()->getManager();
        $_project   = $em->getRepository('MainBundle:Project')->findOneBy(['id'=>$project]);
        $_source    = $em->getRepository('MainBundle:Task')->findOneBy(['id'=>$source]);
        $_target    = $em->getRepository('MainBundle:Task')->findOneBy(['id'=>$target]);

        if($_project != null && $_source != null && $_target != null){

            $link = new Link();
            $link->setSource($_source);
            $link->setTarget($_target);
            $link->setType($type);
            $link->setProject($_project);

            $this->denyAccessUnlessGranted("create",$link);

            $em->persist($link);
            $em->flush();

            $link = $this->get('mainbundle.service.link')->json($link);

            return new JsonResponse(['id'=>$link['id']], 200);

        }else{
            return new JsonResponse([],400);
        }
        
    }

    /**
     * @Route("api/link/{id}", name="link_api_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function readAction(Link $entity,Request $request){
        $this->denyAccessUnlessGranted('view',$entity);
        return new JsonResponse([
            'data' => $this->get('mainbundle.service.link')->json($entity)
        ], 200);
    }

    /**
     * @Route("api/link/{id}", name="task_api_update", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function updateAction(Link $entity, Request $request){
        $l = $request->request->get('link');
        $source = $l['source'];
        $type = $l['type'];
        $target = $l['target'];
        $project = $l['project'];


        $em = $this->getDoctrine()->getManager();
        $_project   = $em->getRepository('MainBundle:Project')->findOneBy(['id'=>$project]);
        $_source    = $em->getRepository('MainBundle:Task')->findOneBy(['id'=>$source]);
        $_target    = $em->getRepository('MainBundle:Task')->findOneBy(['id'=>$target]);

        if($_project != null && $_source != null && $_target != null){

            $link->setSource($_source);
            $link->setTarget($_target);
            $link->setType($type);
            $link->setProject($_project);

            $this->denyAccessUnlessGranted("edit",$link);

            $em->persist($link);
            $em->flush();

            return new JsonResponse([
                'data'=> $this->get('mainbundle.service.link')->json($link)
            ], 200);

        }else{
            return new JsonResponse([],400);
        }
    }

    
    /**
     * @Route("api/links", name="link_api_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $token = $request->request->get('token');
        $id = $request->request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Link')->findOneById($id);
        if($entity != null){
            $this->denyAccessUnlessGranted('delete',$entity);
            $em->remove($entity);
            $em->flush();
            $response = new JsonResponse([],200);
        }else{
            $response = new JsonResponse([],400);
        }
        return $response;
    }
}