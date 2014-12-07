
Select an article to edit or create a new one
<form action="" method=post>
    <select name="formArticleSelect">
        <option value="">Select...</option>
        <?php  foreach ($articleArray as $article):
            ?>
            <option value=<?php echo $article->getArticleArticleID() ?>><?php echo $article->getArticleArticleName(); ?></option>
        <?php
        endforeach;?>
        <option value="N">Create New</option>
    </select>
    <input type=submit value="Select" name ="selectArticle">
</form>


<?php
require_once('../Controller/pageController.php');
$pageController = new Page;








//WHEN DELETE IS PRESSED
if(isset($_POST['btnDeleteArticle']))
{
    $id = $_POST['hiddenIdArticle'];

    $this->model->deleteArticle($id);

    echo "Delete Successful";

}



//WHEN UPDATE IS PRESSED
if(isset($_POST['btnUpdateArticle']))
{
        //USER ID GOES HERE
    $user = 1;

    $id = $_POST['hiddenIdArticle'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $associatedContentArea = $_POST['formCASelect'];
    $associatedPage = $_POST['formPageSelect'];

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


    $this->model-> updateArticle($id, $associatedContentArea,$allPages,$name,$title, $description,$associatedPage,$user, $content);


}



if(isset($_POST['btnNewArticle']))
{

    //USER INFORMATON GOES HERE
    $CreatedBy = 1;

    $name = $_POST['newNameArticle'];
    $desc = $_POST['newDescriptionArticle'];
    $title = $_POST['newTitleArticle'];
    $content = $_POST['newContent'];

    $pageId = $_POST['formPageNewSelect'];
    $CAID = $_POST['formNewCASelect'];


    //IF ALL PAGES IS SELECTED
    if($pageId == "P")
    {
        $allPages =1;
        $pageId=1;

    }
    else
    {
        $allPages =0;
    }

    $this->model->insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$CreatedBy);

    echo "Insert Successful";


}







//WHEN AN ARTICE IS SELECTED FROM THE DROP DOWN
if(isset($_POST['selectArticle']))
{

    $selectedID = $_POST['formArticleSelect'];

    if( $selectedID == "N")
    {
        //IF CREATING A NEW ARTICLE
        ?>


        <form action="" method=post>
        Article Name: <input type="text" name="newNameArticle" ></p>
                Article Description:

                <textarea rows="4" cols="50" name="newDescriptionArticle"></textarea>

                </p>

                Title: <input type="text" name="newTitleArticle" >

                </p>


                Content:<textarea rows="4" cols="50" name="newContent"></textarea>

                </p>

                Associated Page
                <?php
                $pageObjects = $pageController->model->retrieveAllPages();


                    ?>

                        <select name="formPageNewSelect">
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

                    <select name="formNewCASelect">
                        <option value="">Select...</option>
                        <?php foreach($areaArray as $area):
                            ?>
                            <option value=<?php echo $area->getContentID(); ?>><?php echo $area->getarticleName(); ?></option>
                        <?php
                        endforeach;?>
                    </select>



                </p>

                <input type=submit value="Create New" name ="btnNewArticle">
            </form>

        <?php


        }


    else
    {

    //IF UPDATING A SELECTED ARTICLE

    foreach ($articleArray as $article):


        if( $selectedID ==$article->getArticleArticleID())
        {
            $name = $article->getArticleArticleName();
            $description = $article->getArticleArticleDescription();
            $title = $article->getArticleArticleTitle();
            $content = $article->getarticleContent();

            ?>



            <form action="" method=post>
                Article Name: <input type="text" name="name" value=<?php echo $name; ?>></p>
                Article Description:

                <textarea rows="4" cols="50" name="description"><?php  echo   $description;?></textarea>

                </p>

                Title: <input type="text" name="title" value=<?php echo  $title; ?>>

                </p>


                Content:<textarea rows="4" cols="50" name="content"><?php  echo    $content;?></textarea>

                </p>

                Associated Page
                <?php
                $pageObjects = $pageController->model->retrieveAllPages();


                    ?>

                        <select name="formPageSelect">
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

                    <select name="formCASelect">
                        <option value="">Select...</option>
                        <?php foreach($areaArray as $area):
                            ?>
                            <option value=<?php echo $area->getContentID(); ?>><?php echo $area->getarticleName(); ?></option>
                        <?php
                        endforeach;?>
                    </select>



                </p>

                <input type=submit value="Update" name ="btnUpdateArticle">
                <input type=submit value="Delete" name ="btnDeleteArticle">
                <input type ='hidden' value=<?php echo  $selectedID;?> name='hiddenIdArticle'>
            </form>

        <?php


        }

    endforeach;

    }

}






?>



