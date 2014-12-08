<!--DISAPLYS THE CONTENT AREA ON THE PAGE -->

<?php

//WHEN CREATE NEW IS PRESSED
if(isset($_POST['btnNewAuthorCreateArticle']))
{

    //USER INFORMATON GOES HERE
    $CreatedBy = $_SESSION['login_id'];

    $name = $_POST['newAuthorName'];
    $desc = $_POST['newAuthorDescription'];
    $title = $_POST['newAuthorTitle'];
    $content = $_POST['newAuthorContent'];

    $pageId = $_POST['newAuthorFormPageSelect'];
    $CAID = $_POST['newAuthorFormCASelect'];


    //IF ALL PAGES IS SELECTED
    if($pageId == "P")
    {
        $allPages =1;
        $pageId=$_POST['authoranyHiddenPageID'];

    }
    else
    {
        $allPages =0;
    }

    $this->model->insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$CreatedBy);

    echo "Insert Successful";

}





//WHEN DELETE IS PRESSED
if(isset($_POST['btnEditDeleteArticle']))
{
    $user = $_SESSION['login_id'];

    $id = $_POST['editHiddenIdArticle'];
    $name = $_POST['editName'];
    $description = $_POST['editDescription'];
    $title = $_POST['editTitle'];
    $content = $_POST['editContent'];
    $associatedContentArea = null;
    $associatedPage = $_POST['editHiddenIdArticlePage'];
    $allPages=0;
    $delete = true;

    $this->model-> updateArticle($id, $associatedContentArea,$allPages,$name,$title, $description,$associatedPage,$user, $content, $delete);

}



//WHEN UPDATE IS PRESSED
if(isset($_POST['btnEditUpdateArticle']))
{

    //USER ID GOES HERE
    $user = $_SESSION['login_id'];

    $id = $_POST['editHiddenIdArticle'];
    $name = $_POST['editName'];
    $description = $_POST['editDescription'];
    $title = $_POST['editTitle'];
    $content = $_POST['editContent'];
    $associatedContentArea = $_POST['editFormCASelect'];
    $associatedPage = $_POST['editFormPageSelect'];

    //IF ALL PAGES IS SELECTED
    if($associatedPage == "P")
    {
        $allPages =1;
        $associatedPage=1;

    }
    else
    {
        $allPages =0;
    }


    $this->model-> updateArticle($id, $associatedContentArea,$allPages,$name,$title, $description,$associatedPage,$user, $content,false);


}




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


            <form action="" method=post>
                <input type=submit value="Edit <?php echo $name ?>" name = "btnEditArticle" >
                <input type ='hidden' value='<?php echo  $articleID?>' name='autothorHiddenIdArticle'>

            </form>

        <?php


         echo "</article>";

        }

    }

    echo "</div>";
}
echo "</section>";

//make the create new article button disapear if it was already pressed
if(!isset($_POST['btnAuthorNewArticle']))
{
?>
</p>


<form action="" method=post>
<input type=submit value="Create New Article" name = "btnAuthorNewArticle" >
</form>

<?php
}


//IF CREATE NEW IS PRESSED
if(isset($_POST['btnAuthorNewArticle']))
{

?>

<form action="" method=post>

    Article Name: <input type="text" name="newAuthorName" required="true"></p>
Article Description:

                <textarea rows="4" cols="50" name="newAuthorDescription"></textarea>

    </p>

    Title: <input type="text" name="newAuthorTitle" required="true">

    </p>


    Content:<textarea rows="4" cols="50" name="newAuthorContent" required="true"></textarea>

    </p>

    Associated Page
<?php
$pageController = new Page();
$pageObjects = $pageController->model->retrieveAllPages();


?>

    <select name="newAuthorFormPageSelect">
        <option value="">Select...</option>
        <?php  foreach ($pageObjects as $page):
            ?>
            <option value=<?php echo $page->getPageID()?>><?php echo $page->getName(); ?></option>



        <?php
        $anyPageId = $page->getPageID();
        endforeach; ?>
        <option value="P">Apply to all pages</option>
    </select>

    <input type ='hidden' value="<?php echo $anyPageId;?>" name='authoranyHiddenPageID'>
    </p>

    Associated Content Area

    <select name="newAuthorFormCASelect">
        <option value="">Select...</option>
        <?php foreach($areaArray as $area):
            ?>
            <option value=<?php echo $area->getContentID(); ?>><?php echo $area->getarticleName(); ?></option>
        <?php
        endforeach;?>
    </select>



    </p>

<input type=submit value="Create" name ="btnNewAuthorCreateArticle">

    </form>

<?php

}





//IF EDIT BUTTON IS PRESSED
if(isset($_POST['btnEditArticle']))
{
    require_once '../Controller/pageController.php';
    $pageController = new Page();

    $selectedID= $_POST['autothorHiddenIdArticle'];


    foreach ($articleArray as $article):


        if( $selectedID ==$article->getArticleArticleID())
        {
            $name = $article->getArticleArticleName();
            $description = $article->getArticleArticleDescription();
            $title = $article->getArticleArticleTitle();
            $content = $article->getarticleContent();
            $articleAssociatedPageId = $article->getArticleArticlePagesID();
        }
        endforeach;
            ?>



            <form action="" method=post>
                Article Name: <input type="text" name="editName" required="true" value="<?php echo $name; ?>"></p>
                Article Description:

                <textarea rows="4" cols="50" name="editDescription"><?php  echo   $description;?></textarea>

                </p>

                Title: <input type="text" name="editTitle" required="true" value="<?php echo  $title; ?>">

                </p>


                Content:<textarea rows="4" cols="50" name="editContent" required="true"><?php  echo    $content;?></textarea>

                </p>

                Associated Page
                <?php
                $pageObjects = $pageController->model->retrieveAllPages();


                ?>

                <select name="editFormPageSelect">
                    <option value="">Select...</option>
                    <?php  foreach ($pageObjects as $page):
                        ?>
                        <option value=<?php echo $page->getPageID()?>><?php echo $page->getName(); ?></option>
                    <?php
                    endforeach; ?>
                    <option value="P">Apply to all pages</option>
                </select>

                </p>

                Associated Content Area

                <select name="editFormCASelect">
                    <option value="">Select...</option>
                    <?php foreach($areaArray as $area):
                        ?>
                        <option value=<?php echo $area->getContentID(); ?>><?php echo $area->getarticleName(); ?></option>
                    <?php
                    endforeach;?>
                </select>



                </p>

                <input type=submit value="Update" name ="btnEditUpdateArticle">
                <input type=submit value="Delete" name ="btnEditDeleteArticle">

                <input type ='hidden' value=<?php echo  $selectedID;?> name='editHiddenIdArticle'>
                <input type ='hidden' value="<?php echo  $articleAssociatedPageId;?>" name='editHiddenIdArticlePage'>
            </form>

        <?php






    }

?>