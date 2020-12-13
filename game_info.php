<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
$game_id = $_REQUEST['game_id'];
$game=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM join_game where game_id = $game_id"));
if ( isset($_POST["submit_button"]) )
	send_request($game,$u_team_id);
if(isset($_POST["edit_button"]))
	header("Location: joinGame.php");
function send_request($game,$team)
{	
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$type = "join game request";
$msg = "there is  a team want to join your game";
$status = "new";

$sql ="insert into message (sender_id,receiver_id,type,message,date,status,game_id) value($team,$game[1],'$type','$msg',now(),'$status',$game[0])";
mysqli_query($conn,$sql) or die ('Error updating database: '.mysqli_error($conn));
$sql = "insert into team_check value($user,$team,'sent')";
mysqli_close($conn);
$_SESSION["pr_page"] = "game_info";
header("Location: ./request_sent.php");
}
$self = $_SERVER['REQUEST_URI'];
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
			<li><a href="joinGame.php"> Join Game</a></li>
			<li>Game Information</li>
		</ul>
		<div class="body">
			
			
			<div class="form">
				
				<form action="<?php echo $self; ?>" method="post">
					<!-- form table -->
					<table class="table">
						<tr><h1>Join Game</h1></tr>
						
						<tr>
							
							<td>Team Name: </td>
							<td>
								<?php echo $game[2]; ?>
							</td>
							
							<td> Game Date: </td>
							<td>
								<?php echo $game[3]; ?>
							</td>
						</tr>
						<tr>
							
							<td>Game Time:</td>
							<td>
								<?php echo $game[4]; ?>
							</td>
							
							<td>Game Location:</td>
							<td>
								<?php echo $game[5]; ?>
							</td>
						</tr>
						
						<tr>
						
							<td>Game Type:</td>
							<td>
								<?php echo $game[6].":".$game[6]; ?>
							</td>
							
							<td>duration:</td>
							<td>
								<?php echo $game[7]; ?>
							</td>
						</tr>

					</table>	
					
					<p>
						<input type="submit" name="submit_button" value="Send Request"> 
						<input type="submit" name="edit_button" value="Change the game">
					</p>
				</form>
				
			</div>
		</div>
		<?php
		include 'basic/bottom.php';
		?>
	</div>
	

</body>
</html>