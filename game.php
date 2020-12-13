<?php
session_start();

require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
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
           <li>Game</li>
      </ul>
		<div class="body">
			<div class="main-body">
				<div class="row">
					<a href="joinGame.php" class="main-button">
						<div class="ball"></div>
						<span>Join Game</span>
					</a>
					<a href="createGame.php" class="main-button">
						<div class="ball"></div>
						<span>Create Game</span>
					</a>
				</div>


			</div>	

		</div>
		<?php
			include 'basic/bottom.php';
			?>
	</div>

</body>
</html>
