<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

//-------------------------------------------------------------------	
$game_query=mysqli_query($conn,"select * from game_schedule");
$is_null = 0;
if($game_query)
	$is_null =  mysqli_num_rows($game_query);
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
           <li>Schedule</li>
      </ul>
		<div class="body">
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
				while ($game_query && $result = mysqli_fetch_array($game_query)) { 
					?>
					<div class="game">
						<table>
							<tr>
								<td><?php
								echo $result['Date'];
								?></td>
								<td><?php
								echo $result['Time'];
								?></td>
								<td><?php
								echo $result['Location'];
								?></td>
								<td><?php
								echo $result['Host Team'];
								?></td>
								<td><?php
								echo $result['Guest Team'];
								?></td>
								<td><?php
								echo $result['Game Type'].":".$result['Game Type'];	
								?></td>
								<td><?php
								echo $result['Duration'];?>	
							</tr>

						</table>
					</div>
					<?php	
				}
				if($is_null == 0){
				?>

				<div class="game" style=" display: inline-flex; ">
				<table>
					<tr>
						<td style="color: #ffffff"> There is no upcoming Games</td>
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