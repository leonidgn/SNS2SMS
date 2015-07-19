<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADMIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link href="form_style.css" rel="stylesheet" type="text/css" /> 
  <script src="jquery-1.9.1.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script>
	parent.nav.location.reload()
  </script>
</head>
<body style="background:#A9D0F5">

<div class="container">
  <h2>SETUP</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#home">ADMINs</a></li>
    <li><a href="#menu1">TOPICs</a></li>
    <!-- <li><a href="#menu2">Menu 2</a></li> -->
    <!-- <li><a href="#menu3">Menu 3</a></li> --> 
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
       <h2><center>Administrators</center></h2>
	<!--Start PHP Users table -->
  <?php $page_name = (basename($_SERVER['PHP_SELF'])); 
        $table_name = "admin_sms"; 
	echo '<A NAME="top"></A>';
	include 'dbconnect.php';
	//create the query
	$result = mysql_query("select * from $table_name");
	
	echo "<table  align=center class=TFtable>";
	echo "<tr>
	      <th>E-mail</th>
	      <th>Username</th>
	      <th>Password</th>
	   </tr>";
	
	//return the array and loop through each row
	while ($row = mysql_fetch_array($result))
	{
	   echo '<tr>';
	        echo '<td>' . $row['email'] . '</td>';
	        echo '<td>' . $row['name'] . '</td>';
	        echo '<td>' . $row['pswd'] . '</td>';
	   echo '</tr>';
	}
	echo "</table>";
  ?>
	
	<BR></BR>
	
	<form method="post" action="add_user_setup.php" class="elegant-aero">
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
	        <span>* Password :</span>
	        <input id="password"  type="password" name="pswd" placeholder="password"></input>
	    </label>
	
		 <input type="hidden" name="page" value=<?php echo $page_name."#home"; ?>>
	    </label>
	
	     <label>
	        <span>&nbsp;</span>
	        <input name="add" type="submit" id="add" value="Add" class="submit"/>&nbsp;&nbsp;
	        <input name="add" type="submit" id="add" value="Edit" class="submit"/>&nbsp;&nbsp; 
		<input name="add" type="reset" value="Cancel" class="reset"/>
	    </label>
	</form>
	 
	
	
	<BR></BR>
	<form method="post" action="delete-01.php" class="elegant-aero">
	
	    <label>
	        <span>User E-mail :</span>
	        <input id="email" type="text" name="email" placeholder="e-mail"></input>
	        <input type="hidden" name="page" value=<?php echo $page_name."#home"; ?>>
	        <input type="hidden" name="table" value=<?php echo $table_name; ?>>
	    </label> 
	
	     <label>
	        <span>&nbsp;</span>
	        <input name="delete" type="submit" id="delete" value="Delete" class="submit"></input>
	    </label>
	        
	</form>
	<!--End PHP Users table -->
    </div>
    <div id="menu1" class="tab-pane fade">
       <h2><center>SNS Topics</center></h2>
        <!--Start PHP topics table -->
  <?php $page_name = (basename($_SERVER['PHP_SELF'])); 
        $s_table_name = "topic_2_recipients"; 
        echo '<A NAME="top"></A>';
        include 'dbconnect.php';
        //create the query
        $result = mysql_query("select * from $s_table_name");

        echo "<table align=center class=TFtable >";
        echo "<tr align=\"center\">
              <th>Topic</th>
              <th>Page Title</th>
              <th>Butons Title</th>
              <th>DB table name</th>
           </tr>";

        //return the array and loop through each row
        while ($row = mysql_fetch_array($result))
        {
           echo '<tr>';
                echo '<td><font size="2">' . $row['topic'] .      '</font></td>';
                echo '<td><font size="2">' . $row['page_name'] .  '</font></td>';
                echo '<td><font size="2">' . $row['link_name'] .  '</font></td>';
                echo '<td><font size="2">' . $row['table_name'] . '</font></td>';
           echo '</tr>';
        }
        echo "</table>";
  ?>

        <BR></BR>

        <form method="post" action="add_topic_setup.php" class="elegant-aero">
            <label>
                <span>* SNS Topic :</span>
                <input id="topic" type="text" name="topic" placeholder="topic name"></input>
                <input type="hidden" name="page" value=<?php echo $page_name; ?>>
                <input type="hidden" name="stable" value=<?php echo $s_table_name; ?>>
            </label>

            <label>
                <span>* Page Title :</span>
                <input id="page_name" type="text" name="page_name" placeholder="page title"></input>
            </label>

            <label>
                <span>* Button Name :</span>
                <input id="link_name"  type="text" name="link_name" placeholder="button name"></input>
            </label>

            <label>
                <span>* DB table name :</span>
                <input id="table_name"  type="text" name="table_name" placeholder="db table name"></input>
            </label>

                 <input type="hidden" name="page" value=<?php echo $page_name."#menu1"; ?>>
            </label>

             <label>
                <span>&nbsp;</span>
                <input name="add" type="submit" id="add" value="Add" class="submit"/>&nbsp;&nbsp;
                <input name="add" type="submit" id="add" value="Edit" class="submit"/>&nbsp;&nbsp; 
                <input name="add" type="reset" value="Cancel" class="reset"/>
            </label>
        </form>
         


        <BR></BR>
        <form method="post" action="delete-02.php" class="elegant-aero">

            <label>
                <span>* SNS Topic :</span>
                <input id="topic" type="text" name="topic" placeholder="topic name"></input>
                <input type="hidden" name="page" value=<?php echo $page_name."#menu1"; ?>>
                <input type="hidden" name="stable" value=<?php echo $s_table_name; ?>>
            </label> 

             <label>
                <span>&nbsp;</span>
                <input name="delete" type="submit" id="delete" value="Delete" class="submit" ></input>
            </label>
                
        </form>
        <!--End PHP Users table -->
    </div>

<!--    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Page 2.</p>
      </div>
      <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Page 3.</p>
      </div> 
-->

  </div>
</div>

<script>
  $(document).ready(function(){
     $(".nav-tabs a").click(function(){
         $(this).tab('show');
     });
  // enable link to tab
    if(window.location.hash != "") {
      $('a[href="' + window.location.hash + '"]').click()
    }
 
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});
</script>

</body>
</html>


