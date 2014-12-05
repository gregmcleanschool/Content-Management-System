<!--DISAPLYS THE CONTENT AREA ON THE PAGE -->

<?php
echo "<section>";
//LOOPS THROUGH EACH CONTENT AREA
foreach ($areaArray as $area)
{
// all of our content areas are DIVs
    $contentArea = $area->getAlias();
    $contentID= $area->getContentID();
//     echo   $contentArea . '<br>';
 //   echo $contentID . '<br>';

    echo "<div id='$contentArea'>";
//LOOPS THROUGH EACH ARTICLE
    foreach ( $articleArray as $article)
    {


        $name = $article->getarticleName();
        $articleContentID = $article->getarticleContentID(); //
        $content = $article->getarticleContent();
//CHECKS FOR ARTICLES WITH A MATCHING ARTICLECONTENT ID
        if($articleContentID == $contentID)
        {

       echo "<article id='$name'>";

        echo   $name . '<br>';
        echo   $content . '<br>';


         echo "</article>";

        }

    }

    echo "</div>";
}
echo "</section>";

//foreach ( $articleArray as $article)
//{
//// all of our content areas are DIVs
//    $name = $article->getarticleName();
//    $articleContentID = $article->getarticleContentID();
//    $content = $article->getarticleContent();
//
//    echo   $name . '<br>';
//    echo   $articleContentID . '<br>';
//    echo   $content . '<br>';
//
//}

?>