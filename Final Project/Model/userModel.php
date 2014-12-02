<?php

require_once("../Model/Data/mysqli.php");

class userModel
{
    private $UserID;
    private $UserName;
    private $UserPassword;
    private $firstName;
    private $lastName;
    private $passwordSalt;
    private $creationDate;
    private $createdBy;
    private $lastmodifyDate;
    private $lastModifyBy;

    public function getUserID()
    {
        return ($this->UserID);
    }
    public function getUserName()
    {
        return ($this->UserName);
    }
    public function getPasswordSalt()
    {
        return ($this->passwordSalt);
    }

    public static function retrieveUserContent()
    {
        $myDataAccess = new Sqli();

        $myDataAccess->selectUser();

        while($row = $myDataAccess->fetchPages())
        {
            $currentUser = new self();
            $currentUser->UserID = $myDataAccess->fetchUserID($row);
            $currentUser->UserName = $myDataAccess->fetchUserName($row);
            $currentUser->passwordSalt = $myDataAccess->fetchPasswordSalt($row);

            $arrayOfUserObjects[] = $currentUser;
        }

        return $arrayOfUserObjects;
    }


}

?>