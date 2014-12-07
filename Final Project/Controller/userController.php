<?php

require_once("../Model/userModel.php");


class user
{
    public $model;
    public function __construct()
    {
        $this->model = new userModel();
    }

    public function retrieveUserInfo()
    {
        $allUserInfo = $this->model->retrieveUserContent();
        return $allUserInfo;
    }

    public function registerUser($checkUsername,$checkPassword, $firstName, $lastName, $createdBy)
    {
        $um = new userModel();
        $um->register($checkUsername,$checkPassword, $firstName, $lastName, $createdBy);
    }

    public function loginUser($checkUsername,$checkPassword)
    {
        $um = new userModel();
        $um->checkLogin($checkUsername,$checkPassword);
    }


    public function updateUser($userName, $userPassword, $firstName, $lastName, $createdBy,$id)
    {

        $this->model->updateUser($userName, $userPassword, $firstName, $lastName, $createdBy,$id);
    }



    //RETRIEVES PRIVLIGES FOR THE SELECTED USER
    public function retrieveUserPrivileges($id){


       $privArray =  $this->model->retrievePrivileges($id);
        return $privArray;

    }

    //DISPLAY EDIT PAGE
    public function displayUserEditAction(){


        $userArray = $this->model->retrieveUserContent();

        include '../View/userEdit.php';

    }

    //DISPLAY LOGIN PAGE
    public function displayUserAction()
    {

        include '../View/login.php';

    }

    //DELETE ALL PRIVILEGES ASSOCIATED WITH A USER
    PUBLIC FUNCTION deletePrivileges($id){


        $this->model->deletePrivileges($id);

    }

    //INSERT INTO THE USERPRIVILIGES TABLE
    public function insertUserPrivilege($userID,$privilege)
    {
        $this->model->insertUserPrivilege($userID,$privilege);
    }

}

?>