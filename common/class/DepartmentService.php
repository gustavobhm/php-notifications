<?php

class DepartmentService
{
    
    public static function listDepartments()
    {
        return DepartmentDAO::listDepartments();
    }
    
    public static function getDepartmentByID($id)
    {
        return DepartmentDAO::getDepartmentByID($id);
    }
    
}

?>