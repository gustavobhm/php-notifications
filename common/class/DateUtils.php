<?php

class DateUtils
{

    static function formatFromPTBRToMysql($date)
    {
        $dateTime = DateTime::createFromFormat('d/m/Y', $date);

        return $dateTime->format('Y-m-d');
    }
    
    static function formatFromMysqlToPTBR($date)
    {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        
        return $dateTime->format('d/m/Y');
    }
    
}
?>
