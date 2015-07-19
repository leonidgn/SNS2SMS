<html>
<head>
<meta name="GENERATOR" content="Administration">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>navigation</title>
<link rel="stylesheet" href="framesample.css" type="text/css">
</head>
<body class="nav">
<?php
//session_start();
//create a database connection
mysql_connect("localhost","root","1q2w3e4r") or die("Error:".mysqlerror());
//select database
mysql_select_db("grow_mobile");
//create the query
$result = mysql_query("select * from topic_2_recipients");

echo '<p><a class="btn btn-blue" href="sns-qrc.pdf" target="content">AWS SNS</a></p>';

while ($row = mysql_fetch_array($result))
{
//  echo "<p><a class=\"btn btn-blue\" href=\"" . $row['table_name'] . 
//          ".php\" target=\"content\">".$row['link_name']."</a></p>";
  echo "<p><a class=\"btn btn-blue\" href=\"SMS_destrib.php?table_name=" . $row['table_name'] . 
               "\" target=\"content\">".$row['link_name']."</a></p>";
} 

echo '<p><a class="btn btn-blue" href="app_setup.php" title="Setup" target="content">Setup</a>';
echo '<p><a class="btn btn-blue" href="logout.php" title="Log  out" target="_parent">Log  Out</a>';

?>

</body>
</html>
