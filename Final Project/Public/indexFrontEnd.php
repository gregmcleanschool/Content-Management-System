<?php

require_once '../Controller/pageController.php';
require_once'../Controller/contentAreaController.php';
require_once '../Controller/cssController.php';

$pageController = new Page();
$contentAreaController = new ContentArea();
$cssController = new CSS();

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


$pageController->displayAction(true);



//GETS THE SELETECTED PAGE FROM THE NAVIGATION LINKS IN $pageController->displayAction();
if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) )
{
    $selectedPage = $_GET['page'];
    //  $contentAreaController->displayAction($selectedPage);
    $contentAreaController->displayFrontEndAction($selectedPage);
}


require("../View/login.php");
