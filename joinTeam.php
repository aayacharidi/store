<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

$team_query=mysqli_query($conn,"SELECT * FROM join_team where team_id not in (select receiver_id from message where sender_id = $user_id and type = 'join team request' and status in ('new','block'))");
$is_null = 0;
if($team_query)
$is_null = mysqli_num_rows($team_query);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="stylesheet" type="text/css" href="resultDisplay.css">
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
			<li>Join Team</li>
		</ul>
		<div class="body">
			<div class="g_table">
			<div class="game team tit">
				<table>
					<tr style='color: #CA2121'>
						<td>Team Name</td>
						<td>Location</td>
						<td>City</td>
						<td>Plyers number</td>
						<td>Create Date</td>
						<td>points</td>
						<td>Age Range</td>
						<td>Team Captain</td>
						<td> </td>	
					</tr>

				</table>
			</div>
				<?php 

				while ($is_null > 0 && $result = mysqli_fetch_array($team_query)) { 
					?>
					<div class="game team">
						<table>
							<tr>
								<td><?php
								echo $result['team_name'];
								?></td>
								<td><?php
								echo $result['location'];
								?></td>
								<td><?php
								echo $result['city'];
								?></td>
								<td><?php
								echo $result['players_number'];
								?></td>
								<td><?php
								echo $result['create_date'] ;
								?></td>
								<td><?php
								echo $result['point'];	
								?></td>
								<td><?php
								echo $result['age_range'] 	
								?></td>
								<td><?php
								echo $result['Team Captain'];	
								?></td>
								<td class= "join_but"><a href="team_info.php?team_id= <?php echo $result['team_id']?>"> join </a></td>	
							</tr>

						</table>
					</div>
					<?php	
				}

				if($is_null==0){
				?>

				<div class="game team" style=" display: inline-flex; ">
				<table>
					<tr>
						<td style="color: #ffffff"> There is no teams to join</td>
					</tr>
				</table>
			</div>
				<?php } ?>

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