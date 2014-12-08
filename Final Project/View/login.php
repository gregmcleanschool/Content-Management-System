<h2>Login</h2>
<?php

require_once("../Controller/userController.php");

?>
    <html>
        <head>
            <title>Administrator Login</title>
        </head>
        <body>
            <form id="form1" name="form1" method="post" action="">
                <p>
                    <label>User Name: <input type="text" name="username" id="username" required="true"/></label>
                    <label>Password: <input type="password" name="password" required="true"/></label>
                    <input type="submit" name="submit" id="submit" value="Submit" />
                    </p>
                </form>
                </p>

        </body>
    </html>

<?php
session_start(); // Starting Session
$uc = new user();
$error=''; // Variable To Store Error Message
if (isset($_POST['submit']))
    {
        //"select * from User;";
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
        echo $error;
    }
    else
    {
// Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];

        if($uc->model->checkLogin($username, $password))
        {


            //loop through users to get the right id
            $userObjArray = $uc->retrieveUserInfo();
            foreach($userObjArray as $currentUser)
            {
                if($currentUser->getUserName() == $username)
                {
                   $userID= $currentUser->getUserID();
                }
            }

            //get all privileges for that user
            $privObjArray = $uc->model->retrievePrivileges($userID);

            //set all privilieges to 0 by default
            $_SESSION['user_admin']=0;
            $_SESSION['user_editor']=0;
            $_SESSION['user_author']=0;

            foreach( $privObjArray as $currentPrivilege)
            {

                $id = $currentPrivilege->getPrivilegeID();



                if($id ==1)
                {
                    $_SESSION['user_admin']=1;
                }

                if($id ==2)
                {
                    $_SESSION['user_editor']=1;
                }

                if($id ==3)
                {
                    $_SESSION['user_author']=1;
                }


            }

            //setup session variables
            $_SESSION['login_user']=$username;
            $_SESSION['login_id']=$userID;

            header("Location: ../Public/index.php");

        }
        else{

            echo "Login Failed";
        }

    }




}
//EVERYTHING BELOW THIS LINE IS CREATE NEW USER CODE
?>

<!--    <form id="form2" name="form1" method="post" action="">-->
<!--        Create New User-->
<!--        </p>-->
<!--        <label>New User Name: <input type="text" name="usernameCreate" /></label>-->
<!--        </br>-->
<!--        <label>Password: <input type="text" name="passwordCreate" /></label>-->
<!--        </br>-->
<!--        <label>First Name: <input type="text" name="firstNameCreate" /></label>-->
<!--        </br>-->
<!--        <label>Last Name: <input type="text" name="lastNameCreate" /></label>-->
<!--        <input type="submit" name="submitCreate" id="submitCreate" value="Create" />-->
<!--    </form>-->
<!---->
<?php
//
//
//
//
//if (isset($_POST['submitCreate']))
//{
//    $usernameCreate=$_POST['usernameCreate'];
//    $passwordCreate=$_POST['passwordCreate'];
//    $firstNameCreate =$_POST['firstNameCreate'];
//    $lastNameCreate = $_POST['lastNameCreate'];
//
//    //GET THE CURRENT USER
//    $createdBy = 1;//localhost:8081/Public/index.php
//
//    $userController = new user();
//
//
//   $userController->registerUser($usernameCreate,$passwordCreate, $firstNameCreate,$lastNameCreate, $createdBy);
//
//    echo "";
//
//}

?>

