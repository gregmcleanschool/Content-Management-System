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



}

?>