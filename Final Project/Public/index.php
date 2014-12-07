

<?php
//comment from fedi
//USE TINYMCE FOR TEXT AREA

$cssTemplate = 1;
//require_once '../Controller/actorController.php';
require_once '../Controller/cssController.php';
require_once '../Controller/pageController.php';
require_once'../Controller/contentAreaController.php';
require_once '../Model/userModel.php';
require_once("../Controller/userController.php");
require_once("../Controller/siteController.php");

$cssController = new CSS();
$pageController = new Page();
$contentAreaController = new ContentArea();
$userController = new user();
$siteController = new  site();

//check for user login
session_start();
if(! (isset($_SESSION["login_user"]))){
    header("Location: ../View/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php

    $titlePage = 'Default Page';

    if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) )
    {
        $titlePage = $_GET['page'];
        $titlePage= $pageController->aliasConvert($titlePage);

    }

    ?>
    <title><?php echo $titlePage; ?></title>
    <style type="text/css">
       <?php echo $cssController->retrieveCSSTemplate(3); ?>
    </style>
</head>

<?php




//DISPLAYS THE PAGE NAVIGATION LINKS
//$pageController->displayAction();

//DISPLAYS LOGIN PAGE
//$userController->displayUserAction();

//DISAPLYS THE CSS EDIT PAGE
//$cssController->retrieveAllCSSInfo();
//
////DISPLAYS THE CONTENT AREA EDIT PAGE
//$contentAreaController->displayContentAreaEditPage(1);
//
////DISAPLAYS THE ARTICLE EDIT PAGE
//$contentAreaController->displayArticleEditPage();
//
////DISPLAYS THE PAGE EDIT PAGE
//$pageController->displayEditPage();

//DISPLAYS THE USER EDIT PAGE
//$userController->displayUserEditAction();


//IF LOGGED IN AS AUTHOR
if($_SESSION['user_author'] ==1)
{
    ?>
    <h1>Author Front end Panel</h1>

    <?php
    $pageController->displayAction();



    //GETS THE SELETECTED PAGE FROM THE NAVIGATION LINKS IN $pageController->displayAction();
    if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) )
    {
        $selectedPage = $_GET['page'];
        $contentAreaController->displayAction($selectedPage);
    }



}

//IF LOGGED IN AS ADMIN
if($_SESSION["user_admin"] == 1)
{
    ?>
    <h1>Admin Panel</h1>

    <?php
$userController->displayUserEditAction();
}

//IF LOGGED IN AS EDITOR
if($_SESSION['user_editor'] ==1)
{
?>
    <h1>Editor Panel</h1>

    <?php
    $pageController->displayEditPage();
    echo '</p>';
    $contentAreaController->displayArticleEditPage();
    echo '</p>';
    $contentAreaController->displayContentAreaEditPage(1);
    echo '</p>';
    $cssController->retrieveAllCSSInfo();

}



//DISAPLY LOGOUT BUTTON
$siteController->displayLogout();
?>