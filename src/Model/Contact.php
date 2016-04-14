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
    protected $addresses;
    protected $phones;
    protected $notes;
    protected $relations;

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

    public function getAddresses()
    {
        return $this->addresses;
    }

    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    public function getPhones()
    {
        return $this->phones;
    }

    public function setPhones($phones)
    {
        $this->phones = $phones;
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
    
    public function retriveData() {
        $getData = function ($val) {
            return $val->retriveData() ;
        } ;
        
        return array(
            'id' => $this->getId(),
            'book_id' => $this->getBookId(),
            'reference' => $this->getReference(),
            'display_name' => $this->getDisplayName(),
            'emails' => array_map($getData, $this->getEmails() ), 
            'banks' => array_map($getData, $this->getBanks() ),
            'addresses' => array_map($getData, $this->getAddresses() ),
            'phones' => array_map($getData, $this->getPhones() ),
            'notes' => array_map($getData, $this->getNotes() ),
            'relations' => array_map($getData, $this->getRelations() )
        ) ;
    }
}
