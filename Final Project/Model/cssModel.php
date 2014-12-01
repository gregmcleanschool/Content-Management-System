<?php


require_once("../Model/Data/mysqli.php");

class cssModel{

    private $CssID;
    private $CssName;
    private $CssDescription;
    private $CssIsActive;
    private $CssSnippet;


    public function getCSSID()
    {
        return $this->CssID;
    }

    public function getCSSName()
    {
        return $this->CssName;
    }

    public function getCSSDescription()
    {
        return $this->CssDescription;
    }

    public function getCSSIsActive()
    {
        return $this->CssIsActive;
    }

    public function getCSSSnippet()
    {
        return $this->CssSnippet;
    }



    public static function retrieveAllCSS()
    {

        //  $myDataAccess = new Lite();
        $myDataAccess = new Sqli();
        $myDataAccess->selectallCSSInfo();


        while($row = $myDataAccess->fetchPages())
        {
            //  $currentActor = new self($myDataAccess->fetchActorFirstName($row),
            //     $myDataAccess->fetchActorLastName($row));

            $currentPage = new self();
            $currentPage ->CssID= $myDataAccess->fetchCSSID($row);
            $currentPage ->CssName = $myDataAccess->fetchCSSName($row);
            $currentPage ->CssDescription = $myDataAccess->fetchCSSDescription($row);
            $currentPage ->CssIsActive = $myDataAccess->fetchCSSIsActive($row);
            $currentPage ->CssSnippet = $myDataAccess->fetchCSSSnippet($row);

            $arrayOfCssObjects[] = $currentPage;
        }

//        $myDataAccess->closeDB();

        $errors = array_filter($arrayOfCssObjects);

        if (!empty($errors)) {

            return $arrayOfCssObjects;
        }

    }



    function getCSSContent($cssId){
        $dataAccess = new Sqli();

        $result = $dataAccess->selectCSSContent($cssId);

        return $result;

    }



}