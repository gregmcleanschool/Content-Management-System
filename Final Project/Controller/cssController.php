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


    public function retrieveCSSTemplate($template){

        $currentStyle = $this->model->getCSSContent($template);



        return $currentStyle;


    }


}




?>