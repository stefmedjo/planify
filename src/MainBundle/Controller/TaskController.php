<?php

namespace MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use MainBundle\Entity\Project;
use MainBundle\Entity\Task;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class TaskController extends Controller{

    /**
     * @Route("api/tasks", name="task_api_create", methods={"POST"})
     */
    public function createAction(Request $request){
        
        $result = [];
        $status = 200;
        $token  = $request->request->get('task')['token'];
        $t = $request->request->get('task');

        $endDate = $this->get('appbundle.service.date_service')->toDate('m/d/Y',$end);
        $startDate = $this->get('appbundle.service.date_service')->toDate('m/d/Y',$start);

        if($this->isCsrfTokenValid('delete-item', $token)){
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $project = $em->getRepository("MainBundle:Project")->findOneBy(['id'=>$project_id,'company'=> $user->getCompany()]);
            
            if($project != null){                
                $task = new Task();

                $task->setCode($t['code']);
                $task->setProject($project);
                $task->setName($t['text']);
                $task->setStartDate($startDate);
                $task->setEndDate($endDate);
                $task->setIsClosed($t['is_closed']);
                $task->setProgress($t['progress']);
                $task->setDescription($t['description']);

                $this->denyAccessUnlessGranted('create',$task);
                
                $em->persist($task);
                $em->flush();

                $task = $this->get('mainbundle.service.task')->json($task);
                $result = [
                    'success'=> true, 'message'=> '', 'data'=> $task
                ];
                $status = 200;
            }else{
                $result = ['success'=> false, 'message'=> 'Bad Request. Impossible to save this task.'];
                $status = 400;
            }
        }else{
            $result = ['success'=> false, 'message'=> 'Bad Request. Impossible to save this task.'];
            $status = 400;
        }    
        return new JsonResponse($result,$status);
    }

    /**
     * @Route("api/tasks/{id}", name="task_api_read", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function readAction(Task $entity, Request $request){
        $this->denyAccessUnlessGranted('view',$entity);
        $entity = $this->get('mainbundle.service.task')->json($entity);
        return new JsonResponse($entity,200);
    }

    /**
     * @Route("api/tasks/{id}", name="task_api_update", requirements={"id"="\d+"}, methods={"PUT"})
     */
    public function updateAction(Task $task, Request $request){
        
        
        $t = $request->request->get('task');

        if($this->isCsrfTokenValid('delete-item', $t['token'])){
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $project = $em->getRepository("MainBundle:Project")->findOneBy(['id'=>$t['project'],'company'=> $user->getCompany()]);
            
            if($project != null){      
                
                $endDate = $this->get('appbundle.service.date_service')->toDate('m/d/Y',$t['end']);
                $startDate = $this->get('appbundle.service.date_service')->toDate('m/d/Y',$t['start']);
                
                $task->setCode($t['code']);
                $task->setProject($project);
                $task->setName($t['text']);
                $task->setStartDate($startDate);
                $task->setEndDate($endDate);
                $task->setIsClosed($t['is_closed']);
                $task->setProgress($t['progress']);
                $task->setDescription($t['description']);
                
                $this->denyAccessUnlessGranted('edit',$task);

                $em->persist($task);
                $em->flush();

                $task = $this->get('mainbundle.service.task')->json($task);
                
                $result = [
                    'success'=> true, 'message'=> '', 'data'=> $task
                ];
                $status = 200;
            }else{
                $result = ['success'=> false, 'message'=> 'Bad Request. Impossible to save this task.'];
                $status = 400;
            }
        }else{
            $result = ['success'=> false, 'message'=> 'Bad Request. Impossible to save this task.'];
            $status = 400;
        }    
        return new JsonResponse($result,$status);
    }

    /**
     * @Route("api/tasks", name="task_api_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request){
        $response = new JsonResponse();
        $token = $request->request->get('token');
        $id = $request->request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MainBundle:Task')->findOneById($id);
        if($entity != null){
            $this->denyAccessUnlessGranted('delete',$entity);
            $em->remove($entity);
            $em->persist();
            $response = new JsonResponse([],200);
        }else{
            $response = new JsonResponse([],400);
        }
        return $response;
    }

}