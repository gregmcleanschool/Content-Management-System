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


    public function displayAction($forFrontEnd)
    {
        if($forFrontEnd)
        {
            $pageArray = $this->model->retrieveAllPages();

            include '../View/pageListFrontEnd.php';
        }
        else
        {
        $pageArray = $this->model->retrieveAllPages();

        include '../View/pageList.php';
        }
    }


    public function insertPage($name,$alias,$desc,$createdBy)
    {

       $this->model->insertPage($name,$alias,$desc,$createdBy);

    }


    public function displayEditPage(){

        $pageArray = $this->model->retrieveAllPages();

        include '../View/pageEdit.php';

    }


    public function updatePage($id,$name,$alias,$desc,$lastModifyBy){

        $this->model->updatePage($id,$name,$alias,$desc,$lastModifyBy);
    }

    public function deletePage($id){

        $this->model->deletePage($id);

    }

}


?>