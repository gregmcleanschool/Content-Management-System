<!-- BACK END PAGE FOR CSS ALTERING
    NEEDS VALIDATION
 -->




Select a CSS snippet
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
<input type=submit value="Submit">
</form>

<?php

if(isset($_POST['formCSS']) )
{
 $selectedID = $_POST['formCSS'];


    if($selectedID == "N"){
        //CODE FOR NEW CSS
    }
    else
    {
        //CODE FOR UPDATE CSS
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

              <input type=submit value="Update">
              </form>

              <?php

          }

     endforeach;
    }
}


if(isset($_POST['name']))
{
    $snippet = $_POST['snippet'];
    $name = $_POST['name'];
    $desc = $_POST['description'];

    echo $snippet .  $name .  $desc;

}


?>




    <table border="1" style="width:50%">
        <tr>
            <td>ID</td>
            <td>name</td>
            <td>desc</td>
            <td>active?</td>
            <td>snippet</td>
        </tr>
        <tr>
            <?php


            foreach($allCssInfo as $Css):
            ?>
            <td><?php echo $Css->getCSSID() ?></td>
            <td><?php echo $Css->getCSSName(); ?></td>
            <td><?php echo $Css->getCSSDescription(); ?></td>
            <td><?php echo $Css->getCSSIsActive(); ?></td>
            <td><?php echo $Css->getCSSSnippet(); ?></td>
        </tr>
<?php
endforeach;

?>