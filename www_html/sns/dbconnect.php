<?php

//create a database connection
//mysql_connect("localhost","root","1q2w3e4r") or die("Error:".mysqlerror());
//select database
//mysql_select_db("grow_mobile");

$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = '1q2w3e4r';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("grow_mobile");

?>

