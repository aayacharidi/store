<?php
session_start();

require('basic/mysqli_conn.php');
require('basic/loginTest.php');

$team_id = mysqli_query($conn,"select team_id from user where team_id is not NULL and user_name = '$login_user'") or die ('database error: '.mysqli_error());

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="icon" type="image/png" href="img/S63_old.png">
	<title>Sport Event Management</title>
	<style type="text/css">
		
		nav{
   			 border-radius: 0px 0px 12px 12px ;
			}
	</style>
</head>
<body>


	<div class="body_back">
		<?php
		include 'basic/navigation.php';
		?>
		<div class="body" >



			<div class="main-body">
				<div class="row">
					<a href="game.php" class="main-button">
						<div class="ball"></div>
						<span>Games</span>
					</a>
					<a href="myTeam.php" class="main-button">
						<div class="ball"></div>
						<span>My Team</span>
					</a>
				</div>
				<?php 
				if (mysqli_num_rows($team_id) == 0 ){?>
				<div class="row">
					<a href='createTeam.php' class="main-button">
						<div class="ball"></div>
						<span>Creat Team</span>
					</a>
					<a href='joinTeam.php' class="main-button">
						<div class="ball"></div>
						<span>Join Team</span>
					</a>
				</div>

			<?php }?>
			</div>



		</div>
		<?php
		include 'basic/bottom.php';
		?>
	</div>


</body>
</html>
<?php

mysqli_close($conn);
?>