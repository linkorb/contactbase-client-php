<?php

namespace ContactBase\Client\Model;

class ContactPhone
{
    protected $id;
    protected $phone;
    protected $description;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function fillData($data)
    {
        $this->setId($data['id'])
        ->setPhone($data['phone'])
        ->setDescription($data['description'])
        ;
    }

    public function retriveData()
    {
        return get_object_vars($this);
    }
}
