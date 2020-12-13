<?php
session_start();
require('basic/mysqli_conn.php'); 	
require('basic/loginTest.php');

$result = mysqli_query($conn,"select team_name from team where team_id = (select team_id from user where user_name = '$login_user')") or die ('database error: '.mysqli_error($conn));
if(mysqli_num_rows($result)==0)
	join_team();
else	
	display_form('');

function join_team()
{
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
           <li><a href="game.php"> Game</a></li>
           <li>Create Game</li>
      </ul>
			<div class="body">
				<div class="main-body">
					<div class="row">
						<a href='joinTeam.php' class='main-button join_first'>
							<div class="ball"></div>
							<span>Click to Join a Team First!!</span>
						</a>
					</div>
					<div class="row">
						<a href='createTeam.php' class='main-button join_first'>
							<div class="ball"></div>
							<span>Or Click to Create a Team First!!</span>
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
	<?php
}
function display_form()
{
	include 'basic/loginTest.php';
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
           <li>Create Game</li>
      		</ul>
			<div class="body">

				<div class="form">
					<form action="./checkGameInfo.php" id="game_form" onsubmit="return check()">
						<h1>New Game</h1>
						<!-- form table -->

						<table class="table">
							<!-- Game Date -->
							<tr>
								<div id="date_error"></div>
								<div id="time_error"></div>
								<div id="dur_error"></div>
							</tr>
							<tr>
								<td>Game Date:<br>
								</td>
								<td><input class="input" type="date" id="date" name="date" required="required" onchange="date_check(this.value);" ></td>
							</tr>
							<!--Game Time-->
							<tr>
								<td>Game Time: <br>
								</td>
								<td><input class="input" type="time" id="time" name="time" required="required" onchange = "time_check(this.value);" >
								</td>
							</tr>
							<!-- Location -->
							<tr>
								<td>Location:<br>
								</td>
								<td><input class="input" type="text" name="location" required="required"  placeholder="Game Location">
								</td>
							</tr>
							<!-- Game Type  -->
							<tr>
								<td>Game Type:<br>

								</td>
								<td>
									<select class="input" name = "game_type" required="required" >
										<option value=""> [select] </option>
										<option value="1"> 1:1 </option>
										<option value="2"> 2:2 </option>
										<option value="3"> 3:3 </option>
										<option value="4"> 4:4 </option>
										<option value="5"> 5:5 </option>
										<option value="6"> 6:6 </option>
										<option value="7"> 7:7 </option>

									</select>
								</td>
							</tr>
							<!-- Duration-->
							<tr>
								<td>Game Duration:<br>
								</td>
								<td><input class="input" type="text" id="duration" name="duration" required="required" placeholder="Game Duration(e.g. 0.5 hrs)" onchange="dur_check(this.value);" >
								</td>
							</tr>

						</table>
						<!-- create account button -->
						<p>
							<input type="submit" value="Create Game" >
						</p>
					</form>
				</div>	

			</div>
			<?php
			include 'basic/bottom.php';
			?>
		</div>
		<script src="JS/create_game_jc.js"></script>
	</body>
	</html>
	<?php 
}
?>

<?php
mysqli_close($conn);
?>