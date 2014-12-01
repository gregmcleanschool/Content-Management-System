<?php
//fedis comment
require_once('../Model/cssModel.php');
Class CSS
{
    public $model;


    public function __construct()
    {
        $this->model = new cssModel();
    }


    public function retrieveAllCSSInfo(){


        $allCssInfo = $this->model->retrieveAllCSS();
       // return $allCssInfo;

        include '../View/Css.php';

    }

    public function retrieveCSSTemplate($template){

        $currentStyle = $this->model->getCSSContent($template);

        return $currentStyle;


    }


}




?>