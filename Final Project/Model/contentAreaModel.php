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

    private $contentAlias;
    private $contentID;

    private $articleName;
    private $articleContentID;
    private $articleContent;
    private $articleDescription;
    private $articleOrder;

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