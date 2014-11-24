<?php

require_once ('../Model/contentAreaModel.php');

Class ContentArea{

    public $model;


    public function __construct()
    {
        $this->model = new contentAreaModel();



    }


    public function displayAction($pageAlias)
    {

        $pageID = $this->model->convertAliasToPageID($pageAlias);

        $areaArray = $this->model->retrievePageContent($pageID);
        $articleArray = $this->model->retrieveArticleContent($pageID);


        include '../View/contentArea.php';
    }





}


?>