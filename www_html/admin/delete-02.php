<?php
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

mysql_select_db('grow_mobile');
$page = $_POST['page'];
$topic = $_POST['topic'];
$s_table_name = $_POST['stable'];
//Get topics DB table name
$result = mysql_query("select * from $s_table_name WHERE topic = '$topic'");
if(! $result )
{
  die('Could not delete data: ' . mysql_error());
}
$row = mysql_fetch_array($result);
$table_name = $row['table_name'];

//Delete topic definitions from topics table
$sql = "DELETE FROM $s_table_name WHERE topic = '$topic'" ;
//mysql_select_db('grow_mobile');
$retval = mysql_query( $sql );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}

//Delete DB topic table.
$sql = "DROP TABLE IF EXISTS $table_name";
$retval = mysql_query( $sql );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}

mysql_close($conn);
echo '<script>';
echo "parent.nav.location.reload()" ;
echo '</script>';

header("Location:" . $page );
exit();
}
?>
