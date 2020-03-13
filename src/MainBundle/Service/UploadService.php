<?php

namespace MainBundle\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    private $targetDirectory;

    public function __construct(){ 
    }

    public function upload(UploadedFile $file,$type_dir)
    {
        $fileName = "";
        $success = false;
        if($file != null){
            $fileName = md5(uniqid().'mnsa'.uniqid()).'.'.$file->guessExtension();
            
            try {
                $success = true;
                $file->move($type_dir, $fileName);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
        }
        return ["success" => $success, "fileName" => $fileName];
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}