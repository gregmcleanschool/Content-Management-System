<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 11/24/14
 * Time: 2:47 AM
 */
require_once("../Model/Data/mysqli.php");
//ALSO CONTAINS MODEL FOR ARTICLES
class contentAreaModel{


    //ARTICLE ARTICLE VARIABLES BELONG TO THE ARTICLE TABLE
    private $contentAlias;
    private $contentID;

    private $articleArticleName;
    private $articleArticleID;
    private $articleArticleTitle;
    private $articleArticleDescription;
    private $articleArticleCreateDate;
    private $articleArticleCreatedBy;
    private $articleArticlePagesID;
    private $articleArticleAllPages;
    private $articleName;

    private $articleContentID; //content area id associated with article
    private $articleContent;    //FROM ARTICLE TABLE
    private $articleDescription;
    private $articleOrder;


    public function getArticleArticleName(){

        return ($this->articleName);
    }

    public function getArticleArticleAllPages(){

        return ($this->articleArticleAllPages);

    }

    public function getArticleArticlePagesID(){

        return ($this->articleArticlePagesID);

    }

    public function getArticleArticleCreatedBy(){

        return ($this->articleArticleCreatedBy);

    }

    public function getArticleArticleCreateDate(){

        return ($this->articleArticleCreateDate);
    }

    public function getArticleArticleDescription(){

        return ($this->articleArticleDescription);
    }


    public function getArticleArticleID()
    {
        return ($this->articleArticleID);

    }

    public function getArticleArticleTitle()
    {
        return ($this->articleArticleTitle);

    }

    public function getArticleOrder()
    {
        return ($this->articleOrder);
    }


    public function getContentID()
    {
        return ($this->contentID);
    }


    public function getAlias()
    {
        return ($this->contentAlias);
    }

    public function getarticleName()
    {
        return ($this->articleName);
    }


    public function getarticleContentID()
    {
        return ($this->articleContentID);
    }


    public function getarticleContent()
    {
        return ($this->articleContent);
    }

    public function getArticleDescription()
    {
        return ($this->articleDescription);
    }

    public static function retrievePageContent($pageID)
    {

        //  $myDataAccess = new Lite();
        $myDataAccess = new Sqli();



        $myDataAccess->selectContentArea($pageID);


        while($row = $myDataAccess->fetchContentArea())
        {
            //  $currentActor = new self($myDataAccess->fetchActorFirstName($row),
            //     $myDataAccess->fetchActorLastName($row));

            $currentPage = new self();
            $currentPage ->contentAlias = $myDataAccess->fetchContentAreaAlias($row);
            $currentPage->contentID = $myDataAccess->fetchContentAreaID($row);
            $currentPage->articleName = $myDataAccess->fetchContentAreaName($row);
            $currentPage->articleDescription = $myDataAccess->fetchContentAreaDesc($row);
            $currentPage->articleOrder= $myDataAccess->fetchContentAreaOrder($row);

            $arrayOfContentObjects[] = $currentPage;
        }


//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfContentObjects);

        if (!empty($errors)) {

            return $arrayOfContentObjects;
        }

    }

    public function updateContentArea($name,$desc,$order,$updatedBy,$id)
    {
        $myDataAccess = new Sqli();

        $result = $myDataAccess->updateContentArea($name,$desc,$order,$updatedBy,$id);

        return $result;


    }

public function updateArticle($articleId,$contentAreaId,$allPages,$name,$title,$desc,$pageID,$modifiedBy,$content)
{
    $myDataAccess = new Sqli();

    $result = $myDataAccess->updateArticle($articleId,$contentAreaId,$allPages,$name,$title,$desc,$pageID,$modifiedBy,$content);

    return $result;


}

    public function insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$LastModifyBy)
    {

        $myDataAccess = new Sqli();

        $result = $myDataAccess->insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$LastModifyBy);

        return $result;


    }


    public function deleteArticle($id)
    {
        $myDataAccess = new Sqli();

        $result = $myDataAccess->deleteArticle($id);

        return $result;

    }


    public function addContentArea($name,$desc,$order,$createdBy,$alias)
    {

        $myDataAccess = new Sqli();

        $result = $myDataAccess->addContentArea($name,$desc,$order,$createdBy,$alias);

        return $result;

    }


    public function deleteContentArea($id)
    {

        $myDataAccess = new Sqli();

        $result = $myDataAccess->deleteContentArea($id);

        return $result;

    }

    //ARTICLE FUNCTION
    public static function retrieveArticleContent($pageID)
    {

        //  $myDataAccess = new Lite();
        $myDataAccess = new Sqli();

        $myDataAccess->selectArticles($pageID);

        while($row = $myDataAccess->fetchContentArea())
        {
            //  $currentActor = new self($myDataAccess->fetchActorFirstName($row),
            //     $myDataAccess->fetchActorLastName($row));

            $currentArticle = new self();
            $currentArticle ->articleContentID = $myDataAccess->fetchArticleAssociatedContentArea($row);
            $currentArticle ->articleName = $myDataAccess->fetchArticleName($row);
            $currentArticle ->articleContent = $myDataAccess->fetchArticleContent($row);
            $currentArticle ->articleArticleAllPages = $myDataAccess->fetchArticleAllPages($row);
            $currentArticle->articleArticleCreateDate = $myDataAccess->fetchArticleCreateDate($row);
            $currentArticle ->articleArticleCreatedBy = $myDataAccess->fetchArticleCreatedBy($row);
            $currentArticle ->articleArticleDescription = $myDataAccess->fetchArticleDescription($row);
            $currentArticle->articleArticleID =$myDataAccess->fetchArticleID($row);
            $currentArticle ->articleArticlePagesID=$myDataAccess->fetchArticlePageID($row);
            $currentArticle ->articleArticleTitle=$myDataAccess->fetchArticleTitle($row);


            $arrayOfArticleObjects[] = $currentArticle;
        }

//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfArticleObjects);

        if (!empty($errors)) {

            return $arrayOfArticleObjects;
        }

    }



    //ARTICLE FUNCTION
    public static function retrieveAllArticleContent()
    {

        //  $myDataAccess = new Lite();
        $myDataAccess = new Sqli();

        $myDataAccess->selectAllArticles();

        while($row = $myDataAccess->fetchContentArea())
        {
            //  $currentActor = new self($myDataAccess->fetchActorFirstName($row),
            //     $myDataAccess->fetchActorLastName($row));

            $currentArticle = new self();
            $currentArticle ->articleContentID = $myDataAccess->fetchArticleAssociatedContentArea($row);
            $currentArticle ->articleName = $myDataAccess->fetchArticleName($row);
            $currentArticle ->articleContent = $myDataAccess->fetchArticleContent($row);
            $currentArticle ->articleArticleAllPages = $myDataAccess->fetchArticleAllPages($row);
            $currentArticle->articleArticleCreateDate = $myDataAccess->fetchArticleCreateDate($row);
            $currentArticle ->articleArticleCreatedBy = $myDataAccess->fetchArticleCreatedBy($row);
            $currentArticle ->articleArticleDescription = $myDataAccess->fetchArticleDescription($row);
            $currentArticle->articleArticleID =$myDataAccess->fetchArticleID($row);
            $currentArticle ->articleArticlePagesID=$myDataAccess->fetchArticlePageID($row);
            $currentArticle ->articleArticleTitle=$myDataAccess->fetchArticleTitle($row);
            $currentArticle ->articleArticleName = $myDataAccess->fetchArticleName($row);

            $arrayOfArticleObjects[] = $currentArticle;
        }

//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfArticleObjects);

        if (!empty($errors)) {

            return $arrayOfArticleObjects;
        }

    }



    public function convertAliasToPageID($alias)
    {
        $myDataAccess = new Sqli();

       $result = $myDataAccess->aliasPageIdConvert($alias);

        return $result;

    }





}