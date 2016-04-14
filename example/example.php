<?php
include_once __dir__ . '/../vendor/autoload.php';
$username =  'username';
$password =  'password';
$baseUrl =   'http://contactbase.linkorb.com';
$oContactBase = new \ContactBase\Client\Client($username, $password, $baseUrl);
$accountName =  'accountName';
$bookName =   'bookName';
$contactId = 0;
$campaignId = null;

try {
    //--  list all contacts --//
    $entities = $oContactBase->getContacts($accountName, $bookName);

    if ($entities) {
        foreach ($entities as $entity) {
            echo "\n\r";
            echo $entity->getId();
            echo $entity->getBookId();
            echo $entity->getReference();
            echo $entity->getDisplayName();
        }
    }

    //-- contact details + sub-records --//
    $entity = $oContactBase->getContactDetail($accountName, $bookName, $contactId);
    if ($entity) {
        echo $entity->getId();
        echo $entity->getBookId();
        echo $entity->getReference();
        echo $entity->getDisplayName();

        //-- emails --//
        echo '-- Contact Emails --';
        foreach ($entity->getEmails() as $oEmail) {
            echo $oEmail->getId();
            echo $oEmail->getEmail();
            echo $oEmail->getDescription();
        }

        //-- Bank --//
        echo '-- Contact Bank --';
        foreach ($entity->getBanks() as $oBank) {
            echo $oBank->getId();
            echo $oBank->getBanknr();
            echo $oBank->getDescription();
        }

        //-- address --//
        echo '-- Contact Address --';
        foreach ($entity->getAddresses() as $oAddress) {
            echo $oAddress->getId();
            echo $oAddress->getAddressline1();
            echo $oAddress->getAddressline2();
            echo $oAddress->getPostalcode();
            echo $oAddress->getCity();
            echo $oAddress->getCountry();
        }

        //-- Contact Phone --//
        echo '-- Contact Phone --';
        foreach ($entity->getPhones() as $oPhone) {
            echo $oPhone->getId();
            echo $oPhone->getPhone();
            echo $oPhone->getDescription();
        }

        //-- Contact Notes --//
        echo '-- Contact Notes --';
        foreach ($entity->getNotes() as $oNote) {
            echo $oNote->getId();
            echo $oNote->getBody();
            echo $oNote->getCreatedAt();
            echo $oNote->getCreatedBy();
            echo $oNote->getUpdatedAt();
            echo $oNote->getUpdatedBy();
        }

        //-- Contact Relations --//
        echo '-- Contact Relations --';
        foreach ($entity->getRelations() as $oRelation) {
            echo $oRelation->getId();
            echo $oRelation->getRelationId();
            echo $oRelation->getType();
            echo $oRelation->getRelationReference();
            echo $oRelation->getComment();
        }
        
        // change some fields in existed contact and it as new contact
        $entity->setReference('test_reference_'.rand()) ;
        $entity->setDisplayName('test_name_'.rand()) ;

        // change $campaignId from null to valid id for add contact into campaign
        $oContactBase->addContact($accountName, $bookName, $entity, $campaignId) ;
        
    }

    // returns rendered html
} catch (\Exception $e) {
    switch ($e->getCode()) {
        case 400:
            echo 'Bad Request: ', $e->getMessage();
            break;
        case 403:
            echo 'Access denied or Unauthorised: ', $e->getMessage();
            break;
        case 404:
            echo 'Not found: ', $e->getMessage();
            break;
    }
}
