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

    public function addCssTemplate($name,$desc,$snippet,$createdBy){

         $insertReturn = $this->model->addCssContent($name,$desc,$snippet,$createdBy);

        return $insertReturn;

    }

   public function updateCssTemplate($name,$desc,$snippet,$updatedBy,$id)
   {

       $updateReturn = $this->model->updateCssContent($name,$desc,$snippet,$updatedBy,$id);

       return $updateReturn;

   }


    public function deleteCssTemplate($id)
    {
        $deleteReturn = $this->model->deleteCssContent($id);

        return $deleteReturn;

    }


}




?>