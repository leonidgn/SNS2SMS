<html>
<head>
<link href="form_style.css" rel="stylesheet" type="text/css" />
<title>Recording in MySQL Database</title>
</head>
<body style="background:#A9D0F5">

<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != "true" ) {
            header("Location: logout.php");
}

$page_name = (basename($_SERVER['PHP_SELF']));

if(isset($_GET['table_name'])) { 
    $table_name = $_GET['table_name'];
}

//if(isset($_SESSION['table_name'])) {
//   if(!isset($table_name)) {
//        $table_name =  $_SESSION['table_name'];
//    }
//}


//create a database connection
mysql_connect("localhost","grow_mobile_dba","1q2w3e") or die("Error:".mysqlerror());
//select database
mysql_select_db("grow_mobile");
$result = mysql_query("select * from topic_2_recipients where table_name = '$table_name'"); 
$row = mysql_fetch_array($result);

echo '<A NAME="top"></A>';
echo "<h1 align=center>" . $row['page_name'] . "</h1>";
echo "<table  align=center class=TFtable>";
echo "<tr>
      <th>E-mail</th>
      <th>Username</th>
      <th>SMS_Mail&nbsp</th>
   </tr>";

//create the query
$result = mysql_query("select * from $table_name");
//return the array and loop through each row
while ($row = mysql_fetch_array($result))
{
   echo '<tr>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['sms'] . '</td>';
   echo '</tr>';
}
echo "</table>";
?>

<BR></BR>

<form method="post" action="add_user.php" class="elegant-aero">
    <label>
        <span>* User E-mail :</span>
        <input id="email" type="email" name="email" placeholder="e-mail"></input>
	<input type="hidden" name="page" value=<?php echo $page_name; ?>>
        <input type="hidden" name="table" value=<?php echo $table_name; ?>>
    </label>

    <label>
        <span>* UserName :</span>
        <input id="name" type="text" name="name" placeholder="username"></input>
    </label>

    <label>
        <span>* SMS-E-mail :</span>
        <input id="sms"  type="email" name="sms" placeholder="sms"></input>
    </label>

	 <input type="hidden" name="page" value=<?php echo $page_name; ?>>
    </label>

     <label>
        <span>&nbsp;</span>
        <input name="add" type="submit" id="add" value="Add" class="submit"/>
        <input name="add" type="submit" id="add" value="Edit" class="submit"/>
	<input name="add" type="reset" value="Cancel" class="reset"/>
    </label>
</form>
 


<BR></BR>
<form method="post" action="delete-01.php" class="elegant-aero">

    <label>
        <span>User E-mail :</span>
        <input id="email" type="text" name="email" placeholder="e-mail"></input>
        <input type="hidden" name="page" value=<?php echo $page_name; ?>>
        <input type="hidden" name="table" value=<?php echo $table_name; ?>>
    </label> 

     <label>
        <span>&nbsp;</span>
        <input name="delete" type="submit" id="delete" value="Delete" class="submit"></input>
    </label>
        
</form>


</div>
</div>
</body>
</html>
