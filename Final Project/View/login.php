<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
<?php
//calling on th business class
require("../Controller/actorController.php");
$result = "";

//if not empty..POST first name  & last name
if(!empty($_POST['userName']) && !empty($_POST['password']))
{
//new actor being inserted
    $newActor = new Actor($_POST['userName'],$_POST['password']);

    //save the result
    $result = $newActor->save();
}
else
{
    $result = "Nothing to show!";
}
?>
<h1><?php echo $result; ?></h1>
<a href="displayActor.php">Back to Display</a>
</body>
</html>