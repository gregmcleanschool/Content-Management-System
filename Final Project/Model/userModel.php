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



    //****************REGISTER A USER
    public function register($checkUsername,$checkPassword, $firstName, $lastName, $createdBy)
    {
        $myPassword = $checkPassword;
        $myUsername = $checkUsername;

        //strip slashes are taking away the slashes, quotes, etc anything that is not a registered character
//        $myUsername = stripslashes($myUsername);
//        $myPassword = stripslashes($myPassword);
//        $myUsername = mysql_real_escape_string($myUsername);
//        $myPassword = mysql_real_escape_string($myPassword);

        //create a random salt
        $length = 60; //length of salt
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //characters allowed in salt
        $randomString = ''; //salt will be random
        for ($i = 0; $i < $length; $i++) //goes through the array of characters
        {
            $randomString .= $characters[rand(0, strlen($characters) - 1)]; //wants the whole array of characters from 0 to end and -1
        }
        $salt = $randomString; //the salt will be a random string

        for($x=0;$x<3001;$x++)
        {
            $myPassword = hash('sha512',$myPassword.$salt);
            //$myPassword = hash('sha512',$myPassword.$myUsername);
        }

        $dbCon = new Sqli();
        $dbCon->insertUser($myUsername, $myPassword, $salt, $firstName, $lastName, $createdBy);

    }



    //***************CHECKS THE PASSWORD ON THE USER NAME ON LOGIN
    public function checkLogin($checkUsername,$checkPassword)
    {
        $dbCon = new Sqli();

        $myPassword = $checkPassword;
        $myUsername = $checkUsername;
        $salt = $dbCon->fetchUserSalt($dbCon->selectSingleUser($checkUsername));

//        $myUsername = stripslashes($myUsername);
//        $myPassword = stripslashes($myPassword);
//        $myUsername = mysql_real_escape_string($myUsername);
//        $myPassword = mysql_real_escape_string($myPassword);

        //have to pull out the correct salt

        for($x=0;$x<3001;$x++)
        {
            $myPassword = hash('sha512',$myPassword.$salt);
            //$myPassword = hash('sha512',$myPassword.$myUsername);
        }

        if($myPassword == $dbCon->fetchUserPassword($dbCon->selectSingleUser($checkUsername)))
        {
            return true;
        }else
        {
            return false;
        }

    }





}

?>