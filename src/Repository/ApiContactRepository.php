<?php

namespace ContactBase\Client\Repository;

use ContactBase\Client\Client;
use Minerva\Orm\RepositoryInterface;

class ApiContactRepository implements RepositoryInterface
{
    private $oContactBase;
    private $accountName;
    private $bookName;
    private $entities;
    private $loaded;

    public function __construct($username, $password, $baseUrl, $accountName, $bookName)
    {
        $this->oContactBase = new Client($username, $password, $baseUrl);
        $this->accountName = $accountName;
        $this->bookName = $bookName;
        $this->entities = array();
        $this->loaded = false;
    }
    
    public function getModelClassName()
    {
        return 'ContactBase\Client\Model\Contact';
    }

    public function createEntity()
    {
        return Contact::createNew();
    }

    protected $filter = [];
        
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    private function loadEntities()
    {
        try {
            $res = $this->oContactBase->getContacts($this->accountName, $this->bookName);
        } catch (\Exception $e) {
            if ($e->getCode() == 404) {
                $res = null;
            } else {
                throw $e;
            }
        }

        return $res;
    }

    private function loadEntity($contactId)
    {
        try {
            $res = $this->oContactBase->getContactDetail($this->accountName, $this->bookName, $contactId);
        } catch (\Exception $e) {
            if ($e->getCode() == 404) {
                $res = null;
            } else {
                throw $e;
            }
        }

        return $res;
    }

    public function customFindBy($where, $searchText = '')
    {
        $res = array();
        $entities = $this->findBy($where);

        if (!is_null($entities)) {
            if ($searchText == '') {
                $res = $entities;
            } else {
                foreach ($entities as $key => $val) {
                    if (mb_stripos($val->getReference(), $searchText) !== false ||
                        mb_stripos($val->getDisplayName(), $searchText) !== false) {
                        $res[] = $val;
                    }
                }
            }
        }

        return $res;
    }

    public function getTable()
    {
        return $this->getTableName();
    }

    public function getTableName()
    {
        return 'api_contact';
    }

    public function find($id)
    {
        return $this->findOneBy(array('id' => $id));
    }

    public function findOrCreate($id)
    {
        $entity = $this->findOneOrNullBy(array('id' => $id));
        if (!$entity) {
            $entity = $this->createEntity();
        }

        return $entity;
    }

    public function findOneBy($where)
    {
        $entity = $this->findOneOrNullBy($where);

        if (is_null($entity)) {
            throw new Exception(sprintf(
                "Entity '%s' with %s not found",
                $this->getTable(),
                $this->describeWhereFields($where)
            ));
        }

        return $entity;
    }

    public function findOneOrNullBy($where)
    {
        $entity = null;
        $entities = array();
        $isFound = false;
        if (isset($where['id'])) {
            // If 'id' set - then load record with the given id, then filter by other fields
            $entities[] = $this->loadEntity($where['id']);
        } else {
            // If 'id' not set - load all records, then filter it one by one
            $entities = $this->loadEntities();
        }

        if (!is_null($entities) && sizeof($entities) > 0) {
            foreach ($entities as $key => $val) {
                $isFound = true;
                if (isset($where['reference'])) {
                    $isFound &= $where['reference'] == $val->getReference();
                }
                if (isset($where['display_name'])) {
                    $isFound &= $where['display_name'] == $val->getDisplayName();
                }
                if ($isFound) {
                    $entity = $val;
                    break;
                }
            }
        }

        return $entity;
    }

    public function findAll()
    {
        return $this->loadEntities();
    }

    public function findBy($where)
    {
        $res = array();
        $entities = array();
        $isFound = false;
        if (isset($where['id'])) {
            // If 'id' set - then load record with the given id, then filter by other fields
            $entities[] = $this->loadEntity($where['id']);
        } else {
            // If 'id' not set - load all records, then filter it one by one
            $entities = $this->loadEntities();
        }

        if (!is_null($entities) && sizeof($entities) > 0) {
            foreach ($entities as $key => $val) {
                $isFound = true;
                if (isset($where['reference'])) {
                    $isFound &= $where['reference'] == $val->getReference();
                }
                if (isset($where['display_name'])) {
                    $isFound &= $where['display_name'] == $val->getDisplayName();
                }
                if ($isFound) {
                    $res[] = $val;
                }
            }
        }

        return $res;
    }

    public function persist(ModelInterface $entity)
    {
        // we can only add new contact, not update existing (no api call for this now)
        $this->oContactBase->addContact($this->accountName, $this->bookName, $entity);

        return true;
    }

    public function remove(ModelInterface $entity)
    {
        // Not implemented yet (no api call for this now)
    }

    private function describeWhereFields($where)
    {
        return implode(', ', array_map(function ($v, $k) {
            return sprintf("%s='%s'", $k, $v);
        }, $where, array_keys($where)));
    }
}
