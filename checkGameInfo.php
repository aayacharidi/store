<?php
session_start();
require('basic/mysqli_conn.php');


require('basic/loginTest.php');
//-------------------------------------------------------------------
$self = $_SERVER['REQUEST_URI'];
$date = htmlentities($_REQUEST['date']);
$time = htmlentities($_REQUEST['time']);
$location =	htmlentities($_REQUEST['location']);
$game_type = htmlentities($_REQUEST['game_type']);
$duration =	htmlentities($_REQUEST['duration']);

if ( isset($_POST["submit_button"]) )
{
	$team_id = mysqli_fetch_array(mysqli_query($conn,"select team_id from user where user_id = '$user_id'")) or die ('1_ database error: '.mysqli_error($conn));
	$team_id = $team_id[0];

	$MaxIdQuery = mysqli_query($conn,"select max(game_id)+1 from game") or die ('2_Error updating database: '.mysqli_error($conn));
	
	$id = mysqli_fetch_array($MaxIdQuery);
	if(is_null($id[0]))
	{
		$id[0]= 1;
	}

	$sql_game = "INSERT INTO game (game_id, `date`, `time`,  location, team_host_id, game_type, duration) VALUES ($id[0] , '$date' , '$time', '$location', $team_id, $game_type, $duration)";
	mysqli_query($conn,$sql_game) or die ('3_Error updating database: '.mysqli_error($conn));
	mysqli_close($conn);
	header("Location: ./game_created.php");
}

if ( isset($_POST["edit_button"]) )
{
	
	header("Location: ./createGame.php");
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
           <li><a href="game.php"> Game</a></li>
           <li><a href="createGame.php"> Create Game</a></li>
           <li>Game Information</li>
      </ul>
		<div class="body">
			<div class="form result">
				<form action="<?php echo $self; ?>" method="post">
					<!-- form table -->
					<table class="table">
						
						<tr><h1>Join a Game</h1><br></tr>
						<!-- Date -->
						<tr>
							<td>Date: </td>
							<td>
								<?php echo $date; ?>
							</td>
						</tr>
						<!--Time-->
						<tr>
							<td>Time:</td>
							<td>
								<?php echo $time; ?>
							</td>
						</tr>
						<!-- Location -->
						<tr>
							<td>Game Location:</td>
							<td>
								<?php								
									echo $location;
								?>
							</td>
						</tr>
						<!-- Game Type -->
						<tr>
							<td>Game Type:</td>
							<td>
								<?php echo $game_type .":". $game_type; ?>
							</td>
						</tr>
						<!-- Game Duration -->
						<tr>
							<td>Game Duration:</td>
							<td>
								<?php echo $duration; ?>
							</td>
						</tr>
					</table>	
					<!-- create account button -->
					<p>
						<input type="submit" name="submit_button" value="Create"> 
						<input type="submit" name="edit_button" value="Edit">
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