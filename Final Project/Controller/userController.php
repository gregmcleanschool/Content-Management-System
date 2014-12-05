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


}

?>