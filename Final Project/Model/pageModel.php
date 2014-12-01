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


    public function getAlias()
    {
        return ($this->pageAlias);
    }

    public function getName()
    {
        return ($this->pageName);
    }

public static function convertAliasToName($pageAlias){
    $myDataAccess = new Sqli();

  $result =    $myDataAccess->aliasPageTitleConvert($pageAlias);

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

            $arrayOfPageObjects[] = $currentPage;
        }

//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfPageObjects);

        if (!empty($errors)) {

            return $arrayOfPageObjects;
        }




    }






}