<?php

class PEP
{

    private $pep;

    private $doeDate;
    
    private $resolution;
    
    private $firstInstance;
    
    private $secondInstance;
    
    private $finalInstance;

    function __construct($pep, $doeDate, $resolution, $firstInstance, $secondInstance, $finalInstance)
    {
        $this->initials = $pep;
        $this->address = $doeDate;
        $this->resolution = $resolution;
        $this->firstInstance = $firstInstance;
        $this->secondInstance = $secondInstance;
        $this->finalInstance = $finalInstance;
    }

    public function getPEP()
    {
        return $this->pep;
    }

    public function setPEP($pep)
    {
        $this->pep = $pep;
    }
    
    public function getDoeDate()
    {
        return $this->doeDate;
    }
    
    public function setDoeDate($doeDate)
    {
        $this->doeDate = $doeDate;
    }
    
    public function getResolution()
    {
        return $this->resolution;
    }
    
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }
    
    public function getFirstInstance()
    {
        return $this->firstInstance;
    }
    
    public function setFirstInstance($firstInstance)
    {
        $this->firstInstance = $firstInstance;
    }
    
    public function getSecondInstance()
    {
        return $this->secondInstance;
    }
    
    public function setSecondInstance($secondInstance)
    {
        $this->secondInstance = $secondInstance;
    }
    
    public function getFinalInstance()
    {
        return $this->finalInstance;
    }
    
    public function setFinalInstance($finalInstance)
    {
        $this->finalInstance = $finalInstance;
    }
   
}

?>