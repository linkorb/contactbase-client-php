<?php
namespace ContactBase\Client\Model;

class ContactPhone
{
    protected $id;
    protected $contact_id;
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

    public function getContactId()
    {
        return $this->contact_id;
    }

    public function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
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
        ->setContactId($data['contact_id'])
        ->setPhone($data['phone'])
        ->setDescription($data['description'])
        ;
    }
}
