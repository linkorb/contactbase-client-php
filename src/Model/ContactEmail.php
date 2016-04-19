<?php

namespace ContactBase\Client\Model;

class ContactEmail
{
    protected $id;
    protected $email;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

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
        ->setEmail($data['email'])
        ->setDescription($data['description'])
        ;
    }

    public function retriveData()
    {
        return get_object_vars($this);
    }
}
