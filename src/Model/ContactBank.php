<?php
namespace ContactBase\Client\Model;

class ContactBank
{
    protected $id;
    protected $contact_id;
    protected $banknr;
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

    public function getBanknr()
    {
        return $this->banknr;
    }

    public function setBanknr($banknr)
    {
        $this->banknr = $banknr;
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
        ->setBanknr($data['banknr'])
        ->setDescription($data['description'])
        ;
    }
}
