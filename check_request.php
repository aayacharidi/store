<?php
session_start();
require("basic\mysqli_conn.php");
require("basic\loginTest.php");
$message_id = $_REQUEST['message_id'];
$req_status = "old";
$request_query ="update message set status ='$req_status' where message_id = $message_id";
mysqli_query($conn, $request_query) or die ('Error updating database request: '.mysqli_error($conn));
$message= mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM message where message_id = $message_id"));
$game_id = $message['game_id'];
$game=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM join_game where game_id = $game_id"));
$self = $_SERVER['REQUEST_URI'];
if ( isset($_POST["submit_button"]) )
	send_request($game,$u_team_id);
if(isset($_POST["edit_button"]))
	header("Location: players_request.php");
function send_request($game,$team)
{	
	require("basic\mysqli_conn.php");
	$type = "join game request";
	$msg = "there is  a team want to join your game";
	$status = "new";

	$sql ="insert into message (sender_id,receiver_id,type,message,date,status,game_id) value($team,$game[1],'$type','$msg',now(),'$status',$game[0])";
	mysqli_query($conn, $sql) or die ('Error updating database: '.mysqli_error($conn));
	$sql = "insert into team_check value($user,$team,'sent')";
	mysqli_close($conn);
	$_SESSION["pr_page"] = "check_request";
	header("Location: ./request_sent.php");
	}

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
           <li><a href="requests.php">requests</a></li>
           <li><a href="players_request.php">Players Requests</a></li>
           <li>Check a Request</li>
      </ul>
		<div class="body">
			
			
			<div class="form">
				
				<form action="<?php echo $self; ?>" method="post">
					<!-- form table -->
					<table class="table">
						<tr><h1>Join Game</h1></tr>
						
						<tr>
							<!-- Team Name -->
							<td>Team Name: </td>
							<td>
								<?php echo $game[2]; ?>
							</td>
							<!-- Team Captain -->
							<td> Game Date: </td>
							<td>
								<?php echo $game[3]; ?>
							</td>
						</tr>
						<tr>
							<!-- City -->
							<td>Game Time:</td>
							<td>
								<?php echo $game[4]; ?>
							</td>
							<!--Location-->
							<td>Game Location:</td>
							<td>
								<?php echo $game[5]; ?>
							</td>
						</tr>
						
						<tr>
							<!--Plyers number-->
							<td>Game Type:</td>
							<td>
								<?php echo $game[6].":".$game[6]; ?>
							</td>
							<!--Point-->
							<td>duration:</td>
							<td>
								<?php echo $game[7]; ?>
							</td>
						</tr>

					</table>	
					<!-- create account button -->
					<p>
						<input type="submit" name="submit_button" value="Send Request"> 
						<input type="submit" name="edit_button" value="Back to requests">
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