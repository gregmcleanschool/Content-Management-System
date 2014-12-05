

<?php
//comment from fedi
//USE TINYMCE FOR TEXT AREA

$cssTemplate = 1;
//require_once '../Controller/actorController.php';
require_once '../Controller/cssController.php';
require_once '../Controller/pageController.php';
require_once'../Controller/contentAreaController.php';
require_once '../Model/userModel.php';

//$actorController = new Actor();
$cssController = new CSS();
$pageController = new Page();
$contentAreaController = new ContentArea();
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

$cssController->retrieveCSSTemplate($cssTemplate);

//DISPLAYS THE PAGE NAVIGATION LINKS
$pageController->displayAction();


//GETS THE SELETECTED PAGE FROM THE NAVIGATION LINKS IN $pageController->displayAction();
if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) )
{
    $selectedPage = $_GET['page'];
    $contentAreaController->displayAction($selectedPage);
}





//DISAPLYS THE CSS EDIT PAGE
//$cssController->retrieveAllCSSInfo();

//DISPLAYS THE CONTENT AREA EDIT PAGE
//$contentAreaController->displayContentAreaEditPage(1);

//DISAPLAYS THE ARTICLE EDIT PAGE
//$contentAreaController->displayArticleEditPage();

//DISPLAYS THE PAGE EDIT PAGE
$pageController->displayEditPage();

//require_once("../Controller/userController.php");
//$userTest = new user();
//$userArray = $userTest->retrieveUserInfo();
//echo "";


$um = new userModel();

$um->register('testRegister', 'password', 'test', 'name', 1); //test, delete after.




?>