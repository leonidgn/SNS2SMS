<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true" ) {
  //echo "Welcome to the member's area, " . $_SESSION['username'] . "!" . $_SESSION['loggedin'] . "seafasd";

?>
<html><head><title>SMS user adminietration</title></head>
<frameset rows="12%,85%" frameborder="yes">
<frame src="bannerfile.html" name="banner" scrolling="no">
<frameset cols="15%,85%">
<frame src="menu_table.php" name="nav">
<frame src="sns-qrc.pdf" name="content" marginheight="50" marginwidth="50">
</frameset>
<?php
}
 else {
       header("Location: logout.php");
}
?>
