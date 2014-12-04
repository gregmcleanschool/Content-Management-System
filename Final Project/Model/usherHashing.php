
<!--Fedi Inserting the salting and hashing -->


<?php
//****************USER NAME
public function register($checkUsername,$checkPassword)
{
$mypassword = $checkPassword;
$myusername = $checkUsername;

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

//create a random salt
$length = 10;
$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';
for ($i = 0; $i < $length; $i++)
{
$randomString .= $characters[rand(0, strlen($characters) - 1)];
}
$salt = $randomString;

for($x=0;$x<3001;$x++)
{
//  $mypassword = hash('sha512',$mypassword.$salt);
$mypassword = hash('sha512',$mypassword.$myusername);
}

?>

<?php

//***************USER CONNECTIVITY
    public function checkLogin($checkUsername,$checkPassword, $salt)
{
    $mypassword = $checkPassword;
    $myusername = $checkUsername;

    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword);

    //have to pull out the correct salt

    for($x=0;$x<3001;$x++)
    {
        $mypassword = hash('sha512',$mypassword.$salt);
        //$mypassword = hash('sha512',$mypassword.$myusername);
    }

}
    ?>
