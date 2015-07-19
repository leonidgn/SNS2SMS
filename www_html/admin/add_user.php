<?php
session_start();
if(isset($_POST['add']))
{
$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = '1q2w3e4r';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

   $email = $_POST['email'];
   $name = $_POST['name'];
   $sms = $_POST['sms'];
   $page = $_POST['page'];
   $stat = $_POST['add'];
   $stat = strtolower($stat);
   $table_name = $_POST['table'];
//   $_SESSION['table_name'] = $table_name;

if (isset($stat) && !empty($email)) {
    switch (strtolower($stat)) {
        case 'add':
            $sql = "INSERT INTO $table_name ".
       "(email,name,sms) ".
       "VALUES('$email','$name','$sms')";
        break;
        case 'edit':
            $sql = "UPDATE $table_name ".
       "SET sms = '$sms', name = '$name' ".
       "WHERE email = '$email'" ;
    }
  }

mysql_select_db('grow_mobile');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
header("Location:" . $page . "?table_name=" . $table_name );
exit();
}

?>
