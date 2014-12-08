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

    private $privilegeID;


    public function getUserLastName(){

        return ($this->lastName);
    }

    public function getUserFirstName(){

        return ($this->firstName);
    }

    public function getPrivilegeID(){

        return ($this->privilegeID);
    }

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
            $currentUser->firstName = $myDataAccess->fetchUserFirstName($row);
            $currentUser->lastName=$myDataAccess->fetchUserLastName($row);

            $arrayOfUserObjects[] = $currentUser;
        }

        return $arrayOfUserObjects;
    }



    //INSERTS A NEW USER AFTER SALTING AND HASHING
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


    public function updateUser($userName, $userPassword, $firstName, $lastName, $createdBy,$id)
    {

        $myPassword = $userPassword;
        $myUsername = $userName;

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
        //$dbCon->insertUser($myUsername, $myPassword, $salt, $firstName, $lastName, $createdBy);

        $dbCon->updateUser($myUsername,$myPassword,$salt,$firstName,$lastName,$createdBy,$id);
    }



    //restrives all privileges for the selected user
    public static function retrievePrivileges($id){

        $myDataAccess = new Sqli();

        $myDataAccess->selectUserPrivileges($id);

        while($row = $myDataAccess->fetchPages())
        {
            $currentUser = new self();
            $currentUser->privilegeID = $myDataAccess->fetchUserPrivileges($row);

            $arrayOfPrivilegesObjects[] = $currentUser;
        }


        return $arrayOfPrivilegesObjects;


    }


    //***************CHECKS THE PASSWORD ON THE USER NAME ON LOGIN
    public function checkLogin($checkUsername,$checkPassword)
    {
        $dbCon = new Sqli();

        $myPassword = $checkPassword;
        $myUsername = $checkUsername;



        $salt = $dbCon->fetchUserSalt($dbCon->selectSingleUser($myUsername));






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

        if($myPassword == $dbCon->fetchUserPassword($dbCon->selectSingleUser($myUsername)))
        {
            return true;
        }else
        {
            return false;
        }

    }



    PUBLIC FUNCTION deletePrivileges($id)
    {
        $myDataAccess = new Sqli();

        $myDataAccess->deletePrivileges($id);


    }

    public function insertUserPrivilege($userID,$privilege)
    {
        $myDataAccess = new Sqli();

        $myDataAccess->insertUserPrivilege($userID,$privilege);


    }



}

?>