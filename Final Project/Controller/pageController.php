<?php

require_once ('../Model/pageModel.php');

Class Page{

    public $model;


    public function __construct()
    {
        $this->model = new pageModel();
    }


    public function aliasConvert($alias){

        return $this->model->convertAliasToName($alias);
    }


    public function displayAction()
    {
        $pageArray = $this->model->retrieveAllPages();

        include '../View/pageList.php';
    }





}


?>