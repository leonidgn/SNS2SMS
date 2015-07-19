<?php
session_start();
if(isset($_POST['delete']))
{
$dbhost = 'localhost:3036';
$dbuser = 'grow_mobile_dba';
$dbpass = '1q2w3e';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$page = $_POST['page'];
$email = $_POST['email'];
$table_name = $_POST['table'];
//$_SESSION['table_name'] = $table_name;
$sql = "DELETE FROM $table_name WHERE email = '$email'" ;
mysql_select_db('grow_mobile');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}
echo "Deleted data successfully\n";
mysql_close($conn);
header("Location:" . $page . "?table_name=" . $table_name);
exit();
}
?>
