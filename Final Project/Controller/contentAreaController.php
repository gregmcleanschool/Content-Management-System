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


    //DISPLAYS THE EDIT PAGE FOR ALL ARTICLES
    public function displayArticleEditPage(){

        $articleArray = $this->model->retrieveAllArticleContent();
        $areaArray = $this->model->retrievePageContent(1);

        include '../View/articleEdit.php';
    }


    public function insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$LastModifyBy)
    {

        $this->model->insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$LastModifyBy);


    }

    //DISPLAYS THE EDIT PAGE FOR CONTENT AREA
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

    //UPDATES ARTICLE
    public function updateArticle($articleId,$contentAreaId,$allPages,$name,$title,$desc,$pageID,$modifiedBy,$content)
    {
        $this->model->updateArticle($articleId,$contentAreaId,$allPages,$name,$title,$desc,$pageID,$modifiedBy,$content);

    }

    public function deleteContentArea($id)
    {

        $this->model->deleteContentArea($id);

    }


}


?>