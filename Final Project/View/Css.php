<!-- BACK END PAGE FOR CSS ALTERING
    NEEDS VALIDATION
 -->




Select a CSS snippet add or update
<form action="" method=post>
<select name="formCSS">
<option value="">Select...</option>
<?php foreach($allCssInfo as $Css):
    ?>
        <option value=<?php echo $Css->getCSSID() ?>><?php echo $Css->getCSSName(); ?></option>
<?php
endforeach;?>
<option value="N">Create New</option>
</select>
<input type=submit value="Submit" name="submit">
</form>

<?php


$cssController = new CSS();

if(isset($_POST['btnDelete']))
{



    $id = $_POST['hiddenId'];

    $result = $cssController->deleteCssTemplate($id);

    echo $result;


}

if(isset($_POST['newName']))
{
    $createdBy = 1;
    $snippet = $_POST['newSnippet'];
    $name = $_POST['newName'];
    $desc = $_POST['newDescription'];

    $result =  $cssController->addCssTemplate($name,$desc,$snippet,$createdBy);

}

if(isset($_POST['submit']) )
{
 $selectedID = $_POST['formCSS'];


    if($selectedID == "N"){
        //CODE FOR NEW CSS
        ?>


        <form action="" method=post>
            Template Name: <input type="text" name="newName"></p>
            Template Description:

            <textarea rows="4" cols="50" name="newDescription"></textarea>

            </p>

            CSS Snippet:

            <textarea rows="4" cols="50" name="newSnippet"></textarea>

            </p>

            <input type=submit value="Create">
        </form>


        <?php
    }
    else
    {
        //CODE FOR UPDATE CSS FORM
        foreach($allCssInfo as $Css):
          if($selectedID == $Css->getCSSID())
          {
              $isActive = $Css->getCSSIsActive();

              if($isActive == 1)
              {
                  $isActive = "Yes";
              }
              else
              {
                  $isActive = "No";
              }
            ?>

            <form action="" method=post>
             Template Name: <input type="text" name="name" value=<?php echo $Css->getCSSName(); ?>></p>
             Template Description:

              <textarea rows="4" cols="50" name="description"><?php  echo $Css->getCSSDescription();?></textarea>

              </p>

              CSS Snippet:

              <textarea rows="4" cols="50" name="snippet"><?php  echo $Css->getCSSSnippet();?></textarea>

              </p>
              Currently active? </br> <?php echo  $isActive?>

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


if(isset($_POST['btnUpdate']))
{
    //VALUE OF CURRENT USER GOES HERE
    $updatedBy = 1;


    $id = $_POST['hiddenId'];
    $snippet = $_POST['snippet'];
    $name = $_POST['name'];
    $desc = $_POST['description'];

    echo $snippet .  $name .  $desc;



    $result =  $cssController->updateCssTemplate($name,$desc,$snippet,$updatedBy,$id);

    ECHO "Update Successful";
}


if(isset($_POST['applyCSS']))
{
    //WHEN A CSS TEPLATE IS SELECTED TO BE APPLIED

    $selectedID = $_POST['formCSSSET'];



//set all the  templates to inactive

    foreach($allCssInfo as $Css){
$cssController->updateCssActive(0,$Css->getCSSID());
}

    //activeate the selected template

    $cssController->updateCssActive(1,$selectedID);

    echo "Layout Applied";
}




?>

</p>

Select the CSS snippet to apply
<form action="" method=post>
    <select name="formCSSSET">
        <option value="">Select...</option>
        <?php foreach($allCssInfo as $Css):
            ?>
            <option value=<?php echo $Css->getCSSID() ?>><?php echo $Css->getCSSName(); ?></option>
        <?php
        endforeach;?>
    </select>
    <input type=submit value="Use" name ="applyCSS">
</form>

<!--    <table border="1" style="width:50%">-->
<!--        <tr>-->
<!--            <td>ID</td>-->
<!--            <td>name</td>-->
<!--            <td>desc</td>-->
<!--            <td>active?</td>-->
<!--            <td>snippet</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            --><?php
//
//
//            foreach($allCssInfo as $Css):
//            ?>
<!--            <td>--><?php //echo $Css->getCSSID() ?><!--</td>-->
<!--            <td>--><?php //echo $Css->getCSSName(); ?><!--</td>-->
<!--            <td>--><?php //echo $Css->getCSSDescription(); ?><!--</td>-->
<!--            <td>--><?php //echo $Css->getCSSIsActive(); ?><!--</td>-->
<!--            <td>--><?php //echo $Css->getCSSSnippet(); ?><!--</td>-->
<!--        </tr>-->
<?php
//endforeach;

?>