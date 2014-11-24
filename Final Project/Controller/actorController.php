<?php

require_once('../Model/actorModel.php');
Class Actor
{
   public $model;

    public function __construct()
    {
        $this->model = new actorModel();
    }


    public function displayAction($search)
    {
        $arrayOfActors = $this->model->retrieveSome(0,10,$search);

        include '../View/home.php';
    }


    public function deleteAction($actorID)
    {
      $result = $this->model->deleteActor($actorID);
        return $result;
       // include '../View/home.php';
    }

    public function updateAction($actorID,$fName,$lName)
    {
     $result =  $this->model->updateActor($actorID,$fName,$lName);
        return $result;
        // include '../View/home.php';
    }


    public function insertAction($fName,$lName)
    {
        $result = $this->model->insertActor($fName,$lName);
        return $result;
    }



}


?>