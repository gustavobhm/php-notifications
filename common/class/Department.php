<?php

class Department
{

    private $id;

    private $name;

    private $abbreviation;

    function __construct($id, $name, $abbreviation)
    {
        $this->id = $id;
        $this->name = $name;
        $this->abbreviation = $abbreviation;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
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

    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;
    }
}

?>