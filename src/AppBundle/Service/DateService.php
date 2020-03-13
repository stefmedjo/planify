<?php

namespace AppBundle\Service;

class DateService{

    public function __construct(){

    }

    public function toString($format,$date){
        $format = ($format == null) ? "m/d/Y" : $format;
        return $date->format($format);
    }

    public function toDate($format,$date){
        $format = ($format == null) ? "m/d/Y" : $format;
        return \DateTime::createFromFormat($format,$date);
    }

    public function isAfterToday($date){
        $current = new \DateTime('now');
        $diff = $this->firstDateBeforeSecondDate($current,$date);
        return $diff->invert == 0;
    }

    public function firstDateBeforeSecondDate($first,$second){
        $diff = $first->diff($second);
        return $diff;
    }

}