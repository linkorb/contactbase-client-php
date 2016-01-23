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
            $data = json_decode($res->getBody(), true);

            $obj = new Contact();
            $obj->fillData($data);
            $aEmails = [];
            $aBank = [];
            $aAddress = [];
            $aPhone = [];
            $aNotes = [];
            $aRelations = [];

            if (count($data['email']) > 0) {
                foreach ($data['email'] as $email) {
                    $oContactEmail = new ContactEmail();
                    $oContactEmail->fillData($email);
                    $aEmails[] = $oContactEmail;
                }
            }

            if (count($data['bank']) > 0) {
                foreach ($data['bank'] as $bank) {
                    $oContactBank = new ContactBank();
                    $oContactBank->fillData($bank);
                    $aBank[] = $oContactBank;
                }
            }

            if (count($data['address']) > 0) {
                foreach ($data['address'] as $oAddress) {
                    $oContactAddress = new ContactAddress();
                    $oContactAddress->fillData($oAddress);
                    $aAddress[] = $oContactAddress;
                }
            }

            if (count($data['phone']) > 0) {
                foreach ($data['phone'] as $phone) {
                    $oContactPhone = new ContactPhone();
                    $oContactPhone->fillData($phone);
                    $aPhone[] = $oContactPhone;
                }
            }

            if (count($data['note']) > 0) {
                foreach ($data['note'] as $note) {
                    $oContactNote = new ContactPhone();
                    $oContactNote->fillData($note);
                    $aNotes[] = $oContactNote;
                }
            }

            if (count($data['relation']) > 0) {
                foreach ($data['relation'] as $oRelation) {
                    $oContactRelation = new ContactRelation();
                    $oContactRelation->fillData($oRelation);
                    $aRelations[] = $oContactRelation;
                }
            }

            $obj->setEmails($aEmails);
            $obj->setBanks($aBank);
            $obj->setAddress($aAddress);
            $obj->setPhone($aPhone);
            $obj->setNotes($aNotes);
            $obj->setRelations($aRelations);
            return $obj;
        }
        throw new \Exception(json_decode($res->getBody(), true)['error'], $res->getStatusCode());
    }
}
