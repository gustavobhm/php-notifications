<?php

class Template
{

    private $id;

    private $name;

    private $template;
    
    private $departmentID;

    function __construct($name, $template, $departmentID, $id = NULL)
    {
        $this->id = $id;
        $this->name = $name;
        $this->template = $template;
        $this->departmentID = $departmentID;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->name = $template;
    }
    
    public function getDepartmentID()
    {
        return $this->departmentID;
    }
    
    public function setDepartmentID($departmentID)
    {
        $this->departmentID = $departmentID;
    }
    
}

?>