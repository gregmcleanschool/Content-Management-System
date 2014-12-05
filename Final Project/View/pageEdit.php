



<?php

//WHEN DELETE IS PRESSED
if(isset($_POST['btnDelete']))
{
    $id = $_POST['hiddenId'];

    $this->model->deletePage($id);

echo "Delete Success" . "</p>";

}



//WHEN CREATE NEW BUTTON IS PRESSED
if(isset($_POST['btnNew']))
{
  //CURRENT USER ID GOES HERE
    $createdBy = 1;

    $name = $_POST['newName'];
    $desc = $_POST['newDescription'];
    $alias = $_POST['newAlias'];

    $this->model->insertPage($name,$alias,$desc,$createdBy);

    echo "Page Created" . "</p>";

}


if(isset($_POST['btnUpdate']))
{
//WHEN UPDATE IS PRESSED

//CURRENT USER GOES HERE
$lastModifyBy = 1;

$id = $_POST['hiddenId'];
$name = $_POST['name'];
$desc = $_POST['description'];
$alias = $_POST['alias'];


$this->model->updatePage($id,$name,$alias,$desc,$lastModifyBy);

echo "Update Ok" . "</p>";

}

?>


Select a page to edit or create a new one
<form action="" method=post>
    <select name="formPageSelect">
        <option value="">Select...</option>
        <?php  foreach ($pageArray as $page):
            ?>
            <option value=<?php echo $page->getPageID() ?>><?php echo $page->getName(); ?></option>
        <?php
        endforeach;?>
        <option value="N">Create New</option>
    </select>
    <input type=submit value="Select" name ="selectPage">
</form>

<?php
    //WHEN SELECT A PAGE IS PRESSED
    if(isset($_POST['selectPage'])){

        $selectedID = $_POST['formPageSelect'];

        //IF CREATE NEW IS SELECTED
        if($selectedID == "N")
        {
            ?>
            <form action="" method=post>
            Page Name: <input type="text" name="newName"></p>
                    Page Description:

                    <textarea rows="4" cols="50" name="newDescription"></textarea>

                    </p>

                    Page Alias: <input type="text" name="newAlias"></p>

                    </p>

                    <input type=submit value="Create New" name ="btnNew">
                </form>

            <?php
        }
        else
        {
        //IF A PAGE IS SELECTED
        foreach($pageArray as $page):
            if($selectedID == $page->getPageID())
            {

                ?>

                <form action="" method=post>
                    Page Name: <input type="text" name="name" value=<?php echo $page->getName(); ?>></p>
                    Page Description:

                    <textarea rows="4" cols="50" name="description"><?php  echo $page->getPageDescription();?></textarea>

                    </p>

                    Page Alias: <input type="text" name="alias" value=<?php echo $page->getAlias(); ?>></p>

                    </p>

                    <input type=submit value="Update" name ="btnUpdate">
                    <input type=submit value="Delete" name ="btnDelete">
                    <input type ='hidden' value=<?php echo  $selectedID?> name='hiddenId'>
                </form>

            <?php

            }

        endforeach;
        }

   }
