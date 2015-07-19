<?php
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

   $topic = $_POST['topic'];
   $page_name = $_POST['page_name'];
   $link_name = $_POST['link_name'];
   $table_name = $_POST['table_name'];
   $page = $_POST['page'];
   $stat = $_POST['add'];
   $stat = strtolower($stat);
   $s_table_name = $_POST['stable'];

if (isset($stat) && !empty($topic)) {
    switch (strtolower($stat)) {
        case 'add':
            $sql = "INSERT INTO $s_table_name ".
       "(topic,page_name,link_name,table_name) ".
       "VALUES('$topic','$page_name','$link_name','$table_name')";
        break;
        case 'edit':
            $sql = "UPDATE $s_table_name ".
       "SET page_name = '$page_name', link_name = '$link_name', table_name = '$table_name' ".
       "WHERE topic = '$topic'" ;
    }
  }

mysql_select_db('grow_mobile');

  //  if topics table doesn't exist, create it
 $query = "SELECT email FROM " . $table_name;
 $result = mysql_query($query);

  if(empty($result)) {
        $query = "CREATE TABLE IF NOT EXISTS $table_name (
                  email varchar(255) NOT NULL,
                  name varchar(255) NOT NULL,
                  sms varchar(255) NOT NULL,
                  PRIMARY KEY (email)
        )";

        $result = mysql_query($query);
	if(! $result )
	{
	  die('Could not enter data: ' . mysql_error());
	}

	$retval = mysql_query( $sql );
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	} 

        mysql_close($conn);
        header("Location:" . $page );
        exit();
    }
    else {
        mysql_close($conn);
        echo "<h1>     Table " . $table_name . " already  exist!</h1>";
        echo "<h2>         The table name must be unique!</h2>";
    }

}

?>
