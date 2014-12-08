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
        $articleID = $article->getArticleArticleID();
        $name = $article->getArticleArticleName();
        $title = $article->getArticleArticleTitle();
        $articleContentID = $article->getarticleContentID(); //
        $content = $article->getarticleContent();


//CHECKS FOR ARTICLES WITH A MATCHING ARTICLECONTENT ID
        if($articleContentID == $contentID)
        {

       echo "<article id='$name'>";

        echo    $title . '</p>';
        echo   $content . '</p>';
        ?>


        <?php


         echo "</article>";

        }

    }

    echo "</div>";
}
echo "</section>";


