<?php
session_start();
require('basic/mysqli_conn.php');
require('basic/loginTest.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="stylesheet" type="text/css" href="CreateAccount_Style.css">
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
           <li><a href="game.php"> Game</a></li>
           <li><a href="createGame.php"> Create Game</a></li>
           <li>Game Created</li>
      </ul>
		<div class="body">
			<div class="form result">
				<table>
					<tr>
						<td><img style="width: 500px;" src=".\img\done.png"></td>
					</tr>
					<tr>
						<td><p style="color: #ffff;">
							You have created a new Game successfully!!<br>
							Create another game? <a href="createGame.php"> Create Game</a>
						</p></td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			include 'basic/bottom.php';
		?>
	</div>
	
</body>
</html>
