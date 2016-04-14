<?php
namespace ContactBase\Client;

use GuzzleHttp\Client as GuzzleClient;
use ContactBase\Client\Model\Contact;
use ContactBase\Client\Model\ContactEmail;
use ContactBase\Client\Model\ContactBank;
use ContactBase\Client\Model\ContactAddress;
use ContactBase\Client\Model\ContactPhone;
use ContactBase\Client\Model\ContactNote;
use ContactBase\Client\Model\ContactRelation;

class Client
{
    private $username;
    private $password;
    private $baseUrl;
    private $httpClient;

    public function __construct($username, $password, $baseUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->baseUrl = $baseUrl;
        $this->httpClient = new GuzzleClient();
    }

    public function getContacts($accountName, $bookName)
    {
        $res = $this->httpClient->get(
            $this->baseUrl.'/api/v1/'.$accountName.'/'.$bookName.'/contacts',
            ['auth' => [$this->username, $this->password]]
        );

        if ($res->getStatusCode() == 200) {
            $ret = [];
            $data = json_decode($res->getBody(), true);
            foreach ($data as $contact) {
                $obj = new Contact();
                $obj->fillData($contact);
                $ret[] = $obj;
            }
            return $ret;
        }
        throw new \Exception(json_decode($res->getBody(), true)['error'], $res->getStatusCode());
    }

    public function getContactDetail($accountName, $bookName, $id)
    {
        $res = $this->httpClient->get(
            $this->baseUrl.'/api/v1/'.$accountName.'/'.$bookName.'/contacts/'.$id,
            ['auth' => [$this->username, $this->password]]
        );

        if ($res->getStatusCode() == 200) {
            echo $res->getBody()."\n" ;
            $data = json_decode($res->getBody(), true);

            $obj = new Contact();
            $obj->fillData($data);
            $aEmails = [];
            $aBanks = [];
            $aAddresses = [];
            $aPhones = [];
            $aNotes = [];
            $aRelations = [];

            if (count($data['emails']) > 0) {
                foreach ($data['emails'] as $email) {
                    $oContactEmail = new ContactEmail();
                    $oContactEmail->fillData($email);
                    $aEmails[] = $oContactEmail;
                }
            }

            if (count($data['banks']) > 0) {
                foreach ($data['banks'] as $bank) {
                    $oContactBank = new ContactBank();
                    $oContactBank->fillData($bank);
                    $aBanks[] = $oContactBank;
                }
            }

            if (count($data['addresses']) > 0) {
                foreach ($data['addresses'] as $oAddress) {
                    $oContactAddress = new ContactAddress();
                    $oContactAddress->fillData($oAddress);
                    $aAddresses[] = $oContactAddress;
                }
            }

            if (count($data['phones']) > 0) {
                foreach ($data['phones'] as $phone) {
                    $oContactPhone = new ContactPhone();
                    $oContactPhone->fillData($phone);
                    $aPhones[] = $oContactPhone;
                }
            }

            if (count($data['notes']) > 0) {
                foreach ($data['notes'] as $note) {
                    $oContactNote = new ContactNote();
                    $oContactNote->fillData($note);
                    $aNotes[] = $oContactNote;
                }
            }

            if (count($data['relations']) > 0) {
                foreach ($data['relations'] as $oRelation) {
                    $oContactRelation = new ContactRelation();
                    $oContactRelation->fillData($oRelation);
                    $aRelations[] = $oContactRelation;
                }
            }

            $obj->setEmails($aEmails);
            $obj->setBanks($aBanks);
            $obj->setAddresses($aAddresses);
            $obj->setPhones($aPhones);
            $obj->setNotes($aNotes);
            $obj->setRelations($aRelations);
            return $obj;
        }
        throw new \Exception(json_decode($res->getBody(), true)['error'], $res->getStatusCode());
    }
    
    public function addContact($accountName, $bookName, $contact, $campaignId = null) {
        $url = $this->baseUrl.'/api/v1/'.$accountName.'/'.$bookName.'/contact/add' ;
        $data = $contact->retriveData() ;
        
        if(isset($campaignId)) {
            $data['campaign_id'] = $campaignId ;
        }
        
        $res = $this->httpClient->post($url, [
            'auth' => [$this->username, $this->password],
            'body' => json_encode($data)
        ]);
        
        echo $res ;
        //$response = $request->send();
        // ...
    }
}
