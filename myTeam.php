<?php
session_start();

require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$id_query = mysqli_fetch_array(mysqli_query($conn, "SELECT user_id FROM user WHERE user_name = '$login_user' ") )
or die('database error0: '. mysqli_error($conn) );
$userID = $id_query[0];


$team_id_row = mysqli_query($conn, "SELECT `team_id` 
	FROM `team` 
	WHERE `team_id` = (SELECT `team_id` FROM user WHERE user_id = '$userID')" ) 
or die( 'database error1: '. mysqli_error($conn) );



if ( mysqli_num_rows($team_id_row) == 0 ) 
{	
	hasNotTeam();
}
else
{
	hasTeam();
} 

?>

<?php
function hasNotTeam() 
{
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
				<li>My Team page</li>
			</ul>
			<div class="body">

				<div class="main-body">
					<div class="row">
						<a href='joinTeam.php' class='main-button join_first'>
							<div class="ball"></div>
							<span>Click to Join Team First!!</span>
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
} ?>

<?php
function hasTeam() {
	include 'basic/loginTest.php';
	$myteam_columns =
		mysqli_query($conn, "SELECT t.`team_name`, t.`create_date`, t.`point`, t.`location`, t.`city`, t.`players_number`, ar.`Name` as age_range 
			FROM `team` t
				left join `age_range` ar on t.age_range = ar.Id
			WHERE `team_id` = ( SELECT `team_id` 
			FROM `user`
			WHERE `user_id` = '$user_id' )" )  or die( 'database error2: '. mysqli_error($conn) );
	$myteam_columns = mysqli_fetch_array($myteam_columns);

	$playerList = mysqli_query($conn, "SELECT `user_id`, `jersey_no`, concat(`f_name`, ' ', `l_name`) AS 'fullname', 
		`nickname`,  `gender`, `height`, `weight`, `position`
		FROM user
		WHERE `team_id` = ( SELECT `team_id` FROM `user` WHERE `user_id` = '$user_id' )  " ) 
	or die( 'database error3: '. mysqli_error($conn) );

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./HomePage_Style.css">
		<link rel="stylesheet" type="text/css" href="./myTeamStyle.css">
		<link rel="stylesheet" type="text/css" href="./playerListStyle.css">
		<link rel="stylesheet" type="text/css" href="./gameScheduleStyle.css">
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
				<li>My Team page</li>
			</ul>

			<div class="body">
				<!-- insert the code here -->
				<!-- dashboard on th top to display my team information  -->
				<div class="items">
				<div class="container dashboard">
					<h1 id="board_title">
						My Team Information
					</h1>
					<table class="table1">
						<tr class="board_row">
							<td class="board_left">
								<p>Team Name: <?php echo $myteam_columns['team_name']; ?> </p>
								<p>Created Date: <?php echo $myteam_columns['create_date']; ?> </p>
								<p>Points: <?php echo $myteam_columns['point']; ?></p>
							</td>
							<td class="board_right">
								<p>Location: <?php echo $myteam_columns['location']  . ',  ' . $myteam_columns['city']; ?></p>
								<p>Number of Players: <?php echo $myteam_columns['players_number']; ?> </p>
								<p>Age Arange: <?php echo $myteam_columns['age_range']; ?> </p>
							</td>
						</tr>
					</table>
				</div>

				<a href="./gameResult.php"> <button class="resultButton">Games Result</button> </a>

				<div class = "playerList">
					<table>
						<h1 id="player_title">Team's Player List</h1>
					</table>
					<div class="player_col">
						<table>
							<tr style='color: #CA2121'>
								<td>Number#</td>
								<td>Name</td>
								<td>Nick Name</td>
								<td>Gender</td>
								<td>Height</td>
								<td>Weight</td>
								<td>Position</td>
							</tr>
						</table>
					</div>

					<?php while($rows = mysqli_fetch_array($playerList)) 
					{  ?> 

						<div class='player_row'>
							<table>
								<tr>
									<td><?php echo $rows['jersey_no']?></td>
									<td><?php echo $rows['fullname']?></td>
									<td><?php echo $rows['nickname']?></td>
									<td>
										<?php if ( $rows['gender'] == 'm')
										echo "Male";
										elseif ( $rows['gender'] == 'f' )
											echo "Female";
										?>		
									</td>
									<td><?php echo $rows['height']?></td>
									<td><?php echo $rows['weight']?></td>
									<td><?php echo $rows['position']?></td>
								</tr>
							</table>
						</div>

						<?php 
					}  

					?>
				</div>
				<div class = "playerList">
					<table>
						<h1 id="player_title">Games Schedule for My Team</h1>
					</table>


					<div class="g_table">
						<div class="game">
							<table>
								<tr style='color: #CA2121'>
									<td>Date</td>
									<td>Time</td>
									<td>Location</td>
									<td>Host Team</td>
									<td>Guest Team</td>
									<td>Game Type</td>
									<td>Duration</td>

								</tr>

							</table>
						</div>


						<?php 
						$game_query=mysqli_query($conn,"SELECT DISTINCT * FROM `game_schedule`
							WHERE `host` = (SELECT `team_name` FROM `team`
							WHERE team_id = (SELECT `team_id` FROM `user`
							WHERE `user_id` = '$user_id') )");
						$is_null = 0;
						if($game_query <> ''){
							$is_null =  mysqli_num_rows($game_query);
							while ($result = mysqli_fetch_array($game_query)) { 
								?>
								<div class="game">
									<table>
										<tr>
											<td><?php
											echo $result[0];
											?></td>
											<td><?php
											echo $result[1];
											?></td>
											<td><?php
											echo $result[2];
											?></td>
											<td><?php
											echo $result[3];
											?></td>
											<td><?php
											echo $result[4];
											?></td>
											<td><?php
											echo $result[5].":".$result[5];	
											?></td>
											<td><?php
											echo $result[6];?></td>	
										</tr>

									</table>
								</div>
								<?php	
							}
						}
						if($is_null==0)
						{
							?>

							<div class="game" style=" display: inline-flex; ">
								<table>
									<tr>
										<td style="color: #ffffff"> 
											There is no upcoming Games
										</td>
									</tr>
								</table>
							</div>
							<?php
						} 
						?>

					</div>

					<!-- insert the leave team button here and link to another confirmation page -->
					<a href="./leaveTeam.php"> 
						<button class="leaveButton">Leave Team</button> 
					</a>

				</div>
			</div>
				<?php
				include 'basic/bottom.php';
				?>

			</body>
			</html>
			<?php 
		} 
		mysqli_close($conn);
		?>