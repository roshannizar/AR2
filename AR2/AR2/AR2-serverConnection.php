<?php
$con = new mysqli("localhost","root","","ar2");

if($con->connect_error)
{
    echo "Server not  responding...";
}
?>