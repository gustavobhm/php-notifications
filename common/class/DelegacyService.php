<?php

class DelegacyService
{
    
    public static function listDelegacys()
    {
        return DelegacyDAO::listDelegacys();
    }
    
    public static function getDelegacyByInitials($initials)
    {
        return DelegacyDAO::getDelegacyByInitials($initials);
    }
    
}

?>