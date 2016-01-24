<?php
namespace ContactBase\Client\Model;

use Radvance\Model\ModelInterface;
use Radvance\Model\BaseModel;

class ContactNote
{
    protected $id;
    protected $body;
    protected $created_at;
    protected $created_by;
    protected $updated_at;
    protected $updated_by;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
        return $this;
    }

    public function fillData($data)
    {
        $this->setId($data['id'])
        ->setBody($data['body'])
        ->setCreatedAt($data['created_at'])
        ->setCreatedBy($data['created_by'])
        ->setUpdatedAt($data['updated_at'])
        ->setUpdatedBy($tata['updated_by'])
        ;
    }
}
