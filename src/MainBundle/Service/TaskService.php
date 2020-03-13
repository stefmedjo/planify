<?php

namespace MainBundle\Service;

use AppBundle\Service\DateService;

class TaskService{

    private $dateService;

    public function __construct(DateService $dateService){
        $this->dateService = $dateService;
    }

    public function json($task){
        return [
            "id"=> $task->getId(),
            "code"=> $task->getCode(),
            "text"=> $task->getName(),
            "project"=> $task->getProject()->getId(),
            "start_date"=> $this->dateService->toString("m/d/Y",$task->getStartDate()),
            "end_date"=> $this->dateService->toString("m/d/Y",$task->getEndDate()),
            "is_closed"=> $task->getIsClosed(),
            "progress"=> $task->getProgress(),
            "description"=> $task->getDescription()
        ];
    }

}