<?php

require_once("../Controller/userController.php");

?>
    <html>
        <head>
            <title>Administrator Login</title>
        </head>
        <body>
            <form id="form1" name="form1" method="post" action="login.php">
                <p>
                    <label>User Name: <input type="text" id="username" /></label>
                    <label>Password: <input type="text" password="password" /></label>
                    <input type="submit" name="submit" id="submit" value="Submit" />
                </p>
            </form>
        </body>
    </html>

<?php
session_start(); // Starting Session
$uc = new user();
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
// Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];

        if($uc->checkLogin($username, $password))
        {
            $_SESSION['login_user']=$username;
        }

    }
}
?>