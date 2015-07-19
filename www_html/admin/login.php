<!doctype html>
<html lang="en-US">
<head>

	<meta charset="utf-8">

	<title>Login</title>

	<link rel="stylesheet" href="login.css">

</head>

<body>


<?php
session_start();
include 'dbconnect.php';

$pswd = "uyfuyf";
$email = "hght";

if (isset($_POST['pswd']))    
{    
  $pswd = $_POST['pswd'];
}    

if (isset($_POST['email']))
{    
  $email = $_POST['email'];
}    

$test = mysql_query("select * from admin_sms where email = '$email' ");
$data = mysql_fetch_array($test);
$user_passwd = $data['pswd'];

if ((md5($pswd) == $user_passwd)) {

  $_SESSION['loggedin'] = "true";
  $_SESSION['username'] = $_POST['email']; 
header("Location: mysql_form.php");
}
  else {
	$_SESSION['loggedin'] = "false";
	if (isset($_POST['email']) && !empty($_POST['email'])) {
?>
		    <div id="login">
		<p></p><p><h1>Access denied!!!</p></h1>
<?PHP
	}
}
?>

    <div id="login">

	<h2><span class="fontawesome-lock"></span>Sign In</h2>

  	<form name="login"  method="post" action="<?php $_PHP_SELF ?>" >
	    <fieldset>

		<p><label for="email">E-mail address</label></p>
		<p><input type="email" name="email" placeholder="E-mail"</p> 
		<p><label for="password">Password</label></p>
		<p><input type="password" name="pswd" placeholder="password"</p> 
		<p></p>
		<input type="submit" value="Login"/>
		<input type="reset" value="Cancel"/>
		
	    </fieldset>
	</form>


	</div> <!-- end login -->

</body>	
</html> 


