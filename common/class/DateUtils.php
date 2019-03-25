<?php

class DateUtils
{

    static function formatFromPTBRToMysql($date)
    {
        
        if (self::notIsValid($date)){
            return;
        }
        
        $dateTime = DateTime::createFromFormat('d/m/Y', $date);

        return $dateTime->format('Y-m-d');
    }

    static function formatFromMysqlToPTBR($date)
    {
        
        if (self::notIsValid($date)){
            return;
        }
        
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        return $dateTime->format('d/m/Y');
    }

    static function getCurrentDatePTBR()
    {

        $date = new DateTime();

        return $date->format('d/m/Y');
    }
    
    function notIsValid($date){
        return ($date == "" || !isset($date) || $date == null);
    }
    
}
?>
