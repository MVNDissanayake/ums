<?php

//$connection = mysqli_connect(dbserver,dbuser,dbpass,dbname);
$connection = mysqli_connect('localhost','root','','userdb');
//mysqli_connect_errno(); mysqli_connect_error();

// checking the connection1

if(mysqli_connect_error())
{
    die('databass connection faild' . mysqli_connect_error());
}
else
{
    //echo "Connection successfull.";
}
?>

