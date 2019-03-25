<?php

class PEPService
{
    
    public static function listPEPbyCRM($crm)
    {
        return PEPDAO::listPEPbyCRM($crm);
    }
    
    public static function getPEP($pep)
    {
        return PEPDAO::getPEP($pep);
    }
    
}

?>