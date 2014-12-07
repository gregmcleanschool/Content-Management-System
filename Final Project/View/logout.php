<?php

if(isset($_POST['logout']))
{
    // remove all session variables
    session_unset();

// destroy the session
    session_destroy();

    header("Location: ../Public/index.php");
}

?>



<form id="formLogout" name="form1" method="post" action="">
    <p>
        <input type="submit" name="logout" value="Logout" />
    </p>
</form>
</p>

</body>
</html>