
<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$team_id_query = "SELECT `team_id` FROM `user` WHERE `user_id` = '$user_id' ";
				  

$result = mysqli_query($conn,"SELECT DISTINCT `team_host_id`, `team_guest_id`, `host_score`, `guest_score`, `location`, `date`, `game_type`
					   FROM game
					   WHERE (`team_host_id` = (SELECT `team_id` FROM `user` WHERE `user_id` = '$user_id') 
					   OR `team_guest_id` = (SELECT `team_id` FROM `user` WHERE `user_id` = '$user_id') )
					   AND `date` < CURDATE() ")
			or die('database error0: '. mysqli_error($conn) );
					



?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="stylesheet" type="text/css" href="gameResultStyle.css">
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
           <li>Schedule</li>
      </ul>
		<div class="body">
				<table>
					<h1 id="result_title">Games Result</h1>
				</table>
			<div class="gameResult">
				<div class="result_col">
				<table>
					<tr style='color: #CA2121'>
						<td class="hostTeam">Host Team</td>
						<td class="score">Score</td>
<!-- 						<td class="and">&nbsp;&nbsp;</td>
						<td class="col">Score</td> -->
						<td class="guestTeam">Guest Team</td>
						<td class="location">Location</td>
						<td class="date">Date</td>
						<td class="type">Type</td>
					</tr>
				</table>			
				</div>
			</div>

				 <?php while($rows = mysqli_fetch_array($result)) 
				       {  
				       		$team_host_id = $rows['team_host_id'];
				       		$hostTeamName = mysqli_fetch_array(mysqli_query($conn,"SELECT `team_name` FROM `team` WHERE `team_id` = '$team_host_id' ") )
				       												or die('database error1: '. mysqli_error($conn) );

				       		$team_guest_id = $rows['team_guest_id'];
				       		$guestTeamName = mysqli_fetch_array(mysqli_query($conn,"SELECT `team_name` FROM `team` WHERE `team_id` = '$team_guest_id' ") )
				       												or die('database error2: '. mysqli_error($conn) );

				       	?> 
				       	<div class='result_row'>
				       			<table>
				       				<tr>
				       					<td class="row_hostTeam theRow"><?php echo $hostTeamName[0]; ?></td>
				       					<td class="row_hostScore theRow"><?php echo $rows['host_score']?></td>
				       					<td class="bi"> : </td>
				       					<td class="row_guestScore theRow"><?php echo $rows['guest_score']?></td>
				       					<td class="row_guestTeam theRow"><?php echo $guestTeamName[0]; ?></td>
				       					<td class="row_location theRow"><?php echo $rows['location']; ?></td>
				       					<td class="row_date theRow"><?php echo $rows['date']; ?></td>
				       					<td class="row_type theRow">
				       						<?php 
				       							for ($i = 1; $i < 6; $i++) 
				       							{ 
				       								if ( $i == $rows['game_type'] )
				       								{
				       									echo $rows['game_type'] . " V " . $rows['game_type'];
				       									break;
				       								}
				       							}
				       						?>	
				       					</td>
				       				</tr>
				       			</table>
						</div>
				<?php }  ?>				




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





