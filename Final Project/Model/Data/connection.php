<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 9/22/14
 * Time: 4:12 PM
 */

class Connect{

    private $con;

function connect()
{

    $this->con = mysqli_connect("localhost","root","inet2005");
    if (!$this->con)
    {
        die('Could not connect: ' . mysql_error());
    }

    mysqli_select_db( $this->con,"projectCMS");

    return $this->con;
}

    function disconnect()
    {
        $dis = mysqli_close($this->con);

        if (!$dis)
        {
            die('Could not disconnect: ' . mysql_error());
        }

        return $dis;

    }




}

?>