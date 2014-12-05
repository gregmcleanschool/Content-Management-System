<!-- BACK END PAGE FOR CONTENT AREA EDITING
    NEEDS VALIDATION
 -->



<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 12/4/14
 * Time: 9:47 PM
 */

$contentAreaController = new ContentArea();

?>


Select a content area to edit or create a new one
<form action="" method=post>
    <select name="formCaSelect">
        <option value="">Select...</option>
        <?php foreach($areaArray as $area):
    ?>
    <option value=<?php echo $area->getContentID(); ?>><?php echo $area->getarticleName(); ?></option>
<?php
endforeach;?>
<option value="N">Create New</option>
</select>
<input type=submit value="Select" name ="selectCA">
</form>

</p>
<?php
//foreach ($areaArray as $area)
//{
//// all of our content areas are DIVs
//$contentArea = $area->getarticleName();
//$contentID= $area->getContentID();
//$desc = $area->getArticleDescription();
//
//     echo   $contentArea . '<br>';
//   echo $contentID . '<br>';
//    echo $desc . '<br>';
//
//}

//WHEN UPDATE BUTTON IS PRESSED
if(isset($_POST['btnUpdate']))
{
    //SET CURRENT USER HERE
    $user = 1;

    $id  = $_POST['hiddenId'];
    $name = $_POST['name'];
    $description =$_POST['description'];
    $order =  $_POST['order'];

    $contentAreaController->updateContentArea($name,$description,$order,$user,$id );

    echo "Update Successful";

}

if(isset($_POST['btnNewCA']))
{
    //SET CURRENT USER HERE
    $user = 1;


    $name = $_POST['newName'];
    $description =$_POST['newDescription'];
    $order =  $_POST['newOrder'];


    $contentAreaController->addContentArea($name,$description,$order,$user,$name);

    echo "Creation successful";

}




if(isset($_POST['selectCA']))
{
    $slectedID = $_POST['formCaSelect'];


    if($slectedID == 'N' )
    {
        //IF CREATE NEW IS SELECTED IN THE DROP DOWN
    ?>
        <form action="" method=post>
        Content Area Name: <input type="text" name="newName" ></p>
             Content area Description:

              <textarea rows="4" cols="50" name="newDescription"></textarea>

              </p>

              Order on Page: <input type="text" name="newOrder" >

              </p>


              </p>

              <input type=submit value="Create New" name ="btnNewCA">


              </form>

        <?php

    }
    else
    {

    //IF UPDATING A SELECTED CONTENT AREA

    foreach ($areaArray as $area):


        if($slectedID ==$area->getContentID())
        {
            $contentArea = $area->getarticleName();
            $contentID= $area->getContentID();
            $desc = $area->getArticleDescription();
            $name = $area->getarticleName();
            $order = $area->getArticleOrder();



    ?>



    <form action="" method=post>
    Content Area Name: <input type="text" name="name" value=<?php echo $name; ?>></p>
             Content area Description:

              <textarea rows="4" cols="50" name="description"><?php  echo  $desc;?></textarea>

              </p>

              Order on Page: <input type="text" name="order" value=<?php echo  $order; ?>>

              </p>


              </p>

              <input type=submit value="Update" name ="btnUpdate">
                <input type=submit value="Delete" name ="btnDelete">
              <input type ='hidden' value=<?php echo  $slectedID;?> name='hiddenId'>
              </form>

              <?php


        }

    endforeach;
    }
}




?>