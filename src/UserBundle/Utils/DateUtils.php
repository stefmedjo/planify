<?php

namespace UserBundle\Utils;

class DateUtils{ 
    
    public function test(){
        return "hello";
    }

    public static function getExpiredOnDate(){
        $date = new \DateTime("now");
        $date->add(new \DateInterval("P1D")); //Period of 1 Day
        return $date->format("Y-m-d");
    }
    
    public static function getExpiredOnDateTime(){
        $date = new \DateTime("now");
        $date->add(new \DateInterval("P1D")); //Period of 1 Day
        return $date;
    }

    public static function getDiff($val){
        $current_date = new \DateTime("now");
        $date = null;
        if($val instanceof \DateTime){
            $date = $val;
        }else{
            $date = \DateTime::createFromFormat("Y-m-d", $val);
        }
        $diff = $current_date->diff($date);
        
        return ($diff->invert == 1) ? (($diff->days * -1 )) : (1 + $diff->days);
    }

    public static function stringToDate($val){
        return \DateTime::createFromFormat("d/m/Y",$val);
    }

    public static function dateToString($val){
        return $val->format("d/m/Y");
    }

    public static function dateToStringWithFormat($val,$format){
        return $val->format($format);
    }

    public static function stringToDateWithFormat($format,$val){
        return \DateTime::createFromFormat($format,$val);
    }
    
}
