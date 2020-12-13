<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$pr_page = isset($_SESSION["pr_page"])? $_SESSION["pr_page"] : '';;

unset($_SESSION['pr_page']);
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
          <?php
           if($pr_page == "team_info"){           	
           ?>
           <li><a href="joinTeam.php"> Join Team</a></li>
           <?php }
           else if($pr_page == "game_info"){           		
           	?>
           		<li><a href="game.php"> Game</a></li>
           		<li><a href="joinGame.php"> Join Game</a></li>
           	<?php } 
           	else if($pr_page == "check_request"){
           	?>
           <li><a href="requests.php">requests</a></li>
           <li><a href="players_request.php">Players Requests</a></li>
      		<?php } ?>
           <li>Request Sent </li>
      </ul>
		<div class="body">
			<div class="form result">
				<table>
					<tr>
						<td><img style="width: 400px;" src=".\img\done.png"></td>
					</tr>
					<tr>
						<td><p style="color: #ffff;">
							Your request have been sent to the team,<br> wait for the response!!!! <br>
							send another request?
							<?php if($pr_page == "team_info"){
								?>
								 <a href="joinTeam.php"> Join Team</a>
							 <?php } else if($pr_page == "game_info"){?>
							 	 <a href="joinGame.php"> Join Game</a>
							 <?php } else { ?>
							 	<a href="joinGame.php"> Join Game</a> 
							 	<br> or <a href="players_request.php"> check another request</a>
							 <?php } ?>
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