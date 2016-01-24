<?php
namespace ContactBase\Client\Model;

class ContactRelation
{
    protected $id;
    protected $relation_id;
    protected $type;
    protected $comment;
    protected $relation_reference;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getRelationId()
    {
        return $this->relation_id;
    }

    public function setRelationId($relation_id)
    {
        $this->relation_id = $relation_id;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function getRelationReference()
    {
        return $this->relation_reference;
    }

    public function setRelationReference($relation_reference)
    {
        $this->relation_reference = $relation_reference;
        return $this;
    }

    public function fillData($data)
    {
        $this->setId($data['id'])
        ->setRelationId($data['relation_id'])
        ->setType($data['type'])
        ->setComment($data['comment'])
        ->setRelationReference($data['relation_reference'])
        ;
    }
}
