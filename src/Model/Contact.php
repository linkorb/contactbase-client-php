<?php
namespace ContactBase\Client\Model;

class Contact
{
    protected $id;
    protected $book_id;
    protected $reference;
    protected $display_name;
    protected $Emails;
    protected $Banks;
    protected $address;
    protected $phone;
    protected $notes;
    protected $relation;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
        return $this;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }

    public function getDisplayName()
    {
        return $this->display_name;
    }

    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
        return $this;
    }

    public function getEmails()
    {
        return $this->Emails;
    }

    public function setEmails($Emails)
    {
        $this->Emails = $Emails;
        return $this;
    }

    public function getBanks()
    {
         return $this->Banks;
    }

    public function setBanks($Banks)
    {
         $this->Banks = $Banks;
         return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
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

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    public function getRelations()
    {
        return $this->relations;
    }

    public function setRelations($relations)
    {
        $this->relations = $relations;
        return $this;
    }

    public function fillData($data)
    {
        $this->setId($data['id'])
        ->setBookId($data['book_id'])
        ->setReference($data['reference'])
        ->setDisplayName($data['display_name'])
        ;
    }
}
