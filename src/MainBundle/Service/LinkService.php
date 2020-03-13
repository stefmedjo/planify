<?php

namespace MainBundle\Service;

use MainBundle\Entity\Link;

class LinkService{

    public function json(Link $link){
        return [
            'id'    => $link->getId(),
            'source'=> $link->getSource()->getId(),
            'target'=> $link->getTarget()->getId(),
            'type'  => $link->getType()
        ];
    }

}