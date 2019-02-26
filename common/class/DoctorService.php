<?php

class DoctorService
{

    public static function getNameByCRM($crm)
    {
        return DoctorDAO::getNameByCRM($crm);
    }
}

?>