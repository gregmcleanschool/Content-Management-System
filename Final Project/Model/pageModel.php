<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 11/24/14
 * Time: 2:47 AM
 */
require_once("../Model/Data/mysqli.php");

class pageModel{

private $pageAlias;
private $pageName;
private $pageID;
private $pageDescription;

    public function getPageID()
    {
        return ($this->pageID);
    }

    public function getAlias()
    {
        return ($this->pageAlias);
    }

    public function getName()
    {
        return ($this->pageName);
    }

    public function getPageDescription(){

        return ($this->pageDescription);
    }


    public static function convertAliasToName($pageAlias){
        $myDataAccess = new Sqli();

      $result =    $myDataAccess->aliasPageTitleConvert($pageAlias);

        return $result;


    }


        public function updatePage($id,$name,$alias,$desc,$lastModifyBy)
        {
            $myDataAccess = new Sqli();

            $result =    $myDataAccess->updatePage($id,$name,$alias,$desc,$lastModifyBy);

            return $result;


        }


    public static function retrieveAllPages()
    {

        //  $myDataAccess = new Lite();
        $myDataAccess = new Sqli();
        $myDataAccess->selectPages();


        while($row = $myDataAccess->fetchPages())
        {
            //  $currentActor = new self($myDataAccess->fetchActorFirstName($row),
            //     $myDataAccess->fetchActorLastName($row));

            $currentPage = new self();
            $currentPage ->pageAlias = $myDataAccess->fetchPageAlias($row);
            $currentPage ->pageName = $myDataAccess->fetchPageName($row);
            $currentPage->pageID = $myDataAccess->fetchPageID($row);
            $currentPage->pageDescription = $myDataAccess->fetchPageDescription($row);

            $arrayOfPageObjects[] = $currentPage;
        }

//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfPageObjects);

        if (!empty($errors)) {

            return $arrayOfPageObjects;
        }


    }


    public function insertPage($name,$alias,$desc,$createdBy)
    {
        $myDataAccess = new Sqli();

        $result = $myDataAccess->insertPage($name,$alias,$desc,$createdBy);

        return $result;

    }


    public function deletePage($id){
        $myDataAccess = new Sqli();

        $result = $myDataAccess->deletePage($id);

        return $result;

    }


}