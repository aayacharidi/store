<?php
session_start();

require("basic/mysqli_conn.php");
require("basic/loginTest.php");
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
           <li>requests</li>
      </ul>
		<div class="body">
			<div class="main-body">
				<div class="row">
					<a href="team_request.php" class="main-button">
						<div class="ball"></div>
						<span>Team Requests<?php
							if($nav_team_ntf != 0){?>
								<span style="color: red; font-size: 13px;">(
								<?php
								echo $nav_team_ntf;?>
								)</span><?php } ?>

						</span>
					</a>
					<a href="game_request.php" class="main-button">
						<div class="ball"></div>
						<span>Game Requests
							<?php
							if($nav_game_ntf != 0){?>
								<span style="color: red; font-size: 13px;">(
								<?php
								echo $nav_game_ntf;?>
								)</span><?php } ?>

						</span>
					</a>
					<a href="players_request.php" class="main-button">
						<div class="ball"></div>
						<span>Players Requests
							<?php
							if($nav_player_ntf != 0){?>
								<span style="color: red; font-size: 13px;">(
								<?php
								echo $nav_player_ntf;?>
								)</span><?php } ?>
						</span>
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
