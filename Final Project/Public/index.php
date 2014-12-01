

<?php

//USE TINYMCE FOR TEXT AREA

$cssTemplate = 1;
//require_once '../Controller/actorController.php';
require_once '../Controller/cssController.php';
require_once '../Controller/pageController.php';
require_once'../Controller/contentAreaController.php';

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

$pageController->displayAction();



if ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) )
{
    $selectedPage = $_GET['page'];
    $contentAreaController->displayAction($selectedPage);
}


//echo "<p>" .$selectedPage;



$cssController->retrieveAllCSSInfo();

//$actorController->displayAction("");




?>