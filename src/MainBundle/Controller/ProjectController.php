<?php

namespace MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use MainBundle\Entity\Project;
use MainBundle\Form\ProjectType;
use UserBundle\Utils\DateUtils;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProjectController extends Controller{

    /**
     * @Route("project/new", name="project_create")
     */
    public function createAction(Request $request){
        $entity = new Project();
        $form = $this->createForm(ProjectType::class,$entity);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $valid = $this->isValid($entity);
            if($valid['success']){
                $user = $this->getUser();
                $entity->setCompany($user->getCompany());

                $this->denyAccessUnlessGranted("create",$entity);

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success','Project successfully created.');
                return $this->redirectToRoute('project_list');
            }else{
                $this->addFlash('error',$valid['message']);
            }
        }
        return $this->render("@Main/project/form.html.twig",['form' => $form->createView()]);
    }

    /**
     * @Route("project/edit/{id}", name="project_edit", requirements={"id"="\d+"})
     */
    public function editAction(Project $entity, Request $request){
        $form = $this->createForm(ProjectType::class,$entity);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $valid = $this->isValid($entity);
            if($valid['success']){
                $user = $this->getUser();
                $entity->setCompany($user->getCompany());

                $this->denyAccessUnlessGranted("edit",$entity);

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success','Project successfully saved.');
                return $this->redirectToRoute('project_list');
            }else{
                $this->addFlash('error',$valid['message']);
            }
        }
        return $this->render("@Main/project/form.html.twig",['form' => $form->createView()]);
    }

    /**
     * @Route("project/view/{id}", name="project_view", requirements={"id"="\d+"})
     */
    public function viewAction(Project $entity,Request $request){
        $this->denyAccessUnlessGranted("view",$entity);
        return $this->render("@Main/project/view.html.twig",['entity' => $entity]);
    }

    /**
     * @Route("project/delete", name="project_delete")
     */
    public function deleteAction(Request $request){
        $id = $request->request->get("id");
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Project')->findByOneId($id);
        if($entity == null){
            $this->addFlash('error','Unable to find this project.');
        }else{
            $this->denyAccessUnlessGranted("delete",$entity);
            $em->remove($entity);
            $this->addFlash('success','The project was successfully deleted.');
        }
        return $this->redirectToRoute('project_list');
    }

    /**
     * @Route("projects", name="project_list")
     */
    public function listAction(Request $request){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository("MainBundle:Project")->findBy(['company'=> $user->getCompany()]);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($all,$request->query->get('page',1), 10);
        return $this->render("@Main/project/list.html.twig",[ 'entities' => $pagination ]);
    }

    /**
     * @Route("project/search", name="project_search")
     */
    public function searchAction(Request $request){
        $user = $this->getUser();
        $searchText = $request->request->get('search');
        $em = $this->getDoctrine()->getManager();
        $results = $em->createQueryBuilder('u')->select(array('u'))->from('MainBundle:Project', 'u')
                        ->where('u.name LIKE :name OR u.code LIKE :code)' )
                        ->setParameter('name','%'.$searchText.'%')
                        ->setParameter('code','%'.$searchText.'%')
                        ->leftJoin('u.company','company')
                        ->andWhere('company.id == :company')
                        ->setParameter('company',$user->getCompany())
                        ->getQuery()
                        ->getArrayResult();

        $response = new JsonResponse($results,200);
        return $response;
    }

    private function isValid($entity){
        $result = ['success' => true, 'message' => ''];
        if(strlen($entity->getCode()) == 0){
            $result = ['success' => false, 'message' => 'Please provide a Project code.'];
        }elseif(strlen($entity->getName()) == 0){
            $result = ['success' => false, 'message' => 'You need to provide a Project Name.'];
        }else{
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $_entity = $em->getRepository("MainBundle:Project")
                          ->findOneBy(['code' => $entity->getCode(), 'company'=> $user->getCompany()]);
            if($_entity == null || $_entity->getId() == $entity->getId()){
                $result = ['success' => true, 'message' => ''];
            }else{
                $result = ['success' => false, 'message' => 'This code is already used. Please provide another one.'];
            }
        }
        return $result;
    }

     /**
     * @Route("api/project/view/{id}", name="project_api_view", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function findOneAction(Project $project,Request $request){
        $tasks = [];
        $taskService = $this->get("mainbundle.service.task");
        foreach($project->getTasks() as $task){
            array_push($tasks,$taskService->json($task));
        }        

        $links = [];
        foreach($project->getLinks() as $link){
            array_push($links,$this->get("mainbundle.service.link")->json($link));
        } 
        //array_push($links,['id'=> 1, "source"=> 5, "target"=>6, "type"=>"0"]);
        return new JsonResponse(['data' => $tasks, 'links'=>$links], 200);
    }

}