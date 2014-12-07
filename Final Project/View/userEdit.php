
Select a user to edit/create
<form action="" method=post>
    <select name="formUserNewSelect">
        <option value="">Select...</option>
        <?php  foreach ($userArray as $user):
            ?>
            <option value=<?php echo $user->getUserID()?>><?php echo $user->getUserName(); ?></option>
        <?php
        endforeach; ?>
        <option value="N">Create new user</option>
    </select>
    <input type=submit value="Submit" name ="btnUserEditSubmit">
</form>


<?php
$userController = new user();
//set all checkboxes to uncked by default
$adminCheck ="";
$authorCheck = "";
$editorCheck = "";


if(isset($_POST['btnUserEditSubmit']))
{ //$selectedUserID
    $selectedUserID = $_POST['formUserNewSelect'];

    if($selectedUserID =='N')
    {
    //IF CREATE NEW IS SELECTED
    ?>
        </p>
  <form action="" method=post>
    UserName: <input type="text" name="NewUserName">
    </p>
    Password: <input type="text" name="NewUserPass" >
    </p>
    First Name: <input type="text" name="NewFirstName">
    </p>
    Last Name: <input type="text" name="NewLastName">

    <input type ='submit' name ='btnUserCreate' value ="Create">
   </form>
    <?php
    }
    else
    {
    //IF UPDATE IS SELECTED
    $privilegesArray = $userController->retrieveUserPrivileges($selectedUserID);


    foreach ($userArray as $user):
        if($user->getUserID() == $selectedUserID )
        {
?>
<form action="" method=post>
    </p>
    UserName: <input type="text" name="UserName" value=<?php echo  $user->getUserName(); ?>>
    </p>
    Password: <input type="text" name="UserPass" >
    </p>
    First Name: <input type="text" name="FirstName" value=<?php echo $user->getUserLastName(); ?>>
    </p>
    Last Name: <input type="text" name="LastName" value=<?php echo  $user->getUserFirstName(); ?>>
    </p>
    <input type ='hidden' name ='hiddenUserId' value =<?php echo $selectedUserID;?>>
        <!-- GENERATE CHECKBOXES -->
    <?php
    }
    if($privilegesArray!=null)
    {
    foreach ($privilegesArray as $priv):

        $userPrivID = $priv->getPrivilegeID();
        //ADMIN
        if($userPrivID == 1)
        {
            $adminCheck = "checked";
        }


        //EDITOR
        if($userPrivID == 2)
        {
            $editorCheck = "checked";
        }


        //AUTHOR
        if($userPrivID == 3)
        {
            $authorCheck = "checked";
        }


    endforeach;

        }//if arrray is null

    endforeach;
?>
        </p>
        Admin Privileges <input type="checkbox" name="admin" <?php echo $adminCheck?>>
        </p>
        Editor Privileges <input type="checkbox" name="editor" <?php echo $editorCheck?>>
        </p>
        Author Privileges <input type="checkbox" name="author" <?php echo $authorCheck?>>
        </p>
        <?php

    ?>


<input type=submit value="Update" name ="btnUserUpdateSubmit">
<input type=submit value="Delete All Privileges" name ="btnUserDeleteSubmit">
</form>
<?php



}
}//end update/create

//WHEN UPDATE BUTTON IS PRESSED
if(isset($_POST['btnUserUpdateSubmit']))
{
    //UPDATE USER TABLE
    $userName = $_POST["UserName"];
    $userPass =$_POST["UserPass"];
    $fName = $_POST["FirstName"];
    $lName = $_POST['LastName'];
    $createdBy = $_SESSION['login_id'];
    $currentUser =  $_POST['hiddenUserId'];

    $userController->updateUser( $userName, $userPass,$fName,$lName,$createdBy, $currentUser);

    //UPDATE USERPRIVILEGES TABLE
    //delete all privilege rows associated with the user
    $userController->deletePrivileges($currentUser);

    //insert privileges needed
    if(isset($_POST['admin']))
    {
        $userController->insertUserPrivilege($currentUser,1);
    }


    if(isset($_POST['editor']))
    {
        $userController->insertUserPrivilege($currentUser,2);
    }

    if(isset($_POST['author']))
    {
        $userController->insertUserPrivilege($currentUser,3);
    }

    echo "Update Successful";
}

//WHEN CREATE BUTTON IS PRESSED
if(isset($_POST['btnUserCreate']))
{
    //INSERT INTO USER TALBE
    $userName = $_POST['NewUserName'];
    $userPass = $_POST['NewUserPass'];
    $firstName = $_POST['NewFirstName'];
    $lastName = $_POST['NewLastName'];
    $createdBy = $_SESSION['login_id'];

    $userController->registerUser($userName,$userPass,$firstName,  $lastName, $createdBy);


    echo "Insert worked";

}

//WHEN DELETE BUTTON IS PRESSED
if(isset($_POST['btnUserDeleteSubmit']))
{
    $currentUser =  $_POST['hiddenUserId'];
    //delete all privilege rows associated with the user
    $userController->deletePrivileges($currentUser);

}



?>