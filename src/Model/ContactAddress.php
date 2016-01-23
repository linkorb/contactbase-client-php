<?php
namespace ContactBase\Client\Model;

class ContactAddress
{
    protected $id;
    protected $addressline1;
    protected $addressline2;
    protected $postalcode;
    protected $city;
    protected $country;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getAddressline1()
    {
        return $this->addressline1;
    }

    public function setAddressline1($addressline1)
    {
        $this->addressline1 = $addressline1;
        return $this;
    }

    public function getAddressline2()
    {
        return $this->addressline2;
    }

    public function setAddressline2($addressline2)
    {
        $this->addressline2 = $addressline2;
        return $this;
    }

    public function getPostalcode()
    {
        return $this->postalcode;
    }

    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function fillData($data)
    {
        $this->setId($data['id'])
        ->setAddressline1($data['addressline1'])
        ->setAddressline2($data['addressline2'])
        ->setPostalCode($data['postalcode'])
        ->setCity($data['city'])
        ->setCountry($data['country'])
        ;
    }
}
