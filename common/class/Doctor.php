<?php

class Doctor
{

    private $crm;

    private $name;

    function __construct($crm, $name)
    {
        $this->crm = $crm;
        $this->name = $name;
    }

    public function getCRM()
    {
        return $this->crm;
    }

    public function setCRM($crm)
    {
        $this->crm = $crm;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}

?>