<?php

require_once ('../Model/contentAreaModel.php');

Class ContentArea{

    public $model;


    public function __construct()
    {
        $this->model = new contentAreaModel();



    }

    //DISPLAYS THE CONTENT AREA AND THE PAGES ON THEM
    public function displayAction($pageAlias)
    {

        $pageID = $this->model->convertAliasToPageID($pageAlias);

        $areaArray = $this->model->retrievePageContent($pageID);
        $articleArray = $this->model->retrieveArticleContent($pageID);


        include '../View/contentArea.php';
    }


    //DISPLAYS THE EDIT PAGE
    public function displayContentAreaEditPage($pageID){



        $areaArray = $this->model->retrievePageContent($pageID);
        $articleArray = $this->model->retrieveArticleContent($pageID);

        include '../View/contentAreaEdit.php';

    }

    //UPDATES THE CONTENT AREA
    public function updateContentArea($name,$desc,$order,$updatedBy,$id)
    {


        $this->model->updateContentArea($name,$desc,$order,$updatedBy,$id);


    }

    //ADDS A NEW CONTENT AREA
    public function addContentArea($name,$desc,$order,$createdBy,$alias)
    {

        $this->model->addContentArea($name,$desc,$order,$createdBy,$alias);

    }


    public function deleteContentArea($id)
    {

        $this->model->deleteContentArea($id);

    }


}


?>