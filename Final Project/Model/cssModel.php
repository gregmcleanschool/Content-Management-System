<?php


require_once("../Model/Data/mysqli.php");

class cssModel{


    function getCSSContent($cssId){
        $dataAccess = new Sqli();

        $result = $dataAccess->selectCSSContent($cssId);

        return $result;

    }



}