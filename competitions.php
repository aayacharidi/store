<?php
session_start();
include 'basic/mysql_conn.php'; 
include 'basic/loginTest.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="icon" type="image/png" href="img/S63_old.png">
	<title>Sport Event Management</title>
</head>
<body>
	
	
	<div class="body_back">
		<?php
			include 'basic/navigation.php';
		?>
		<ul class="breadcrumb">
          <li><a href="homePage.php">Home</a></li>
           <li>Competitions</li>
      </ul>
		
		<div class="body">
			
		<img src=".\img\pic1.jpg">	
			
		</div>
		<?php
			include 'basic/bottom.php';
		?>
	</div>
	

</body>
</html>
