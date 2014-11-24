<?php
echo "<section>";
foreach ($areaArray as $area)
{
// all of our content areas are DIVs
    $contentArea = $area->getAlias();
    $contentID= $area->getContentID();
//     echo   $contentArea . '<br>';
 //   echo $contentID . '<br>';

    echo "<div id='$contentArea'>";

    foreach ( $articleArray as $article)
    {


        $name = $article->getarticleName();
        $articleContentID = $article->getarticleContentID();
        $content = $article->getarticleContent();

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