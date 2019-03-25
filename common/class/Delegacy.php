<?php

class Delegacy
{

    private $initials;
    
    private $type;

    private $address;
    
    private $district;
    
    private $city;
    
    private $state;
    
    private $zipCode;

    function __construct($initials, $type, $address, $district, $city, $state, $zipCode)
    {
        $this->initials = $initials;
        $this->type = $type;
        $this->address = $address;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
    }

    public function getInitials()
    {
        return $this->initials;
    }

    public function setInitials($initials)
    {
        $this->initials = $initials;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
    }
    
    public function getDistrict()
    {
        return $this->district;
    }
    
    public function setDistrict($district)
    {
        $this->district = $district;
    }
    
    public function getCity()
    {
        return $this->city;
    }
    
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    public function getState()
    {
        return $this->state;
    }
    
    public function setState($state)
    {
        $this->state = $state;
    }
    
    public function getZipCode()
    {
        return $this->zipCode;
    }
    
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }
   
}

?>