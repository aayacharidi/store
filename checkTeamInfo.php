<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

//-------------------------------------------------------------------
$self = $_SERVER['REQUEST_URI'];
$team_name=htmlentities($_SESSION['team_name']);
$location=htmlentities($_SESSION['location']);
$city=htmlentities($_SESSION['city']);
$age_range='';
if($_SESSION['age_range'] != '')
	$age_range=htmlentities($_SESSION['age_range']);

if ( isset($_POST["submit_button"]) )
{
	$user_id = mysqli_fetch_array(mysqli_query($conn,"select user_id from user where user_name = '$login_user'")) or die ('1_ database error: '.mysqli_error($conn));
	
	$players_num=1;
	$point = 0;
	$id = mysqli_fetch_array(mysqli_query($conn,"select max(team_id)+1 from team")) or die ('2_Error updating database: '.mysqli_error($conn));
	if(!isset($id[0])){
		$id[0]=1;
	}
	$sql_team = "INSERT INTO team (team_id, team_name, city,  players_number, create_date ,`point`,user_id) VALUES ($id[0] , '$team_name' , '$city', $players_num, NOW(), $point, $user_id[0])";
	$sql_user = "update user set team_id = $id[0] where user_id = $user_id[0]";
	mysqli_query($conn,$sql_team) or die ('3_Error updating database: '.mysqli_error($conn));
	mysqli_query($conn,$sql_user) or die ('4_Error updating database: '.mysqli_error($conn));
	if($location!=''){
		$sql = "update team set location = '$location' where team_id =$id[0]";
		mysqli_query($conn,$sql) or die ('5_Error updating database: '.mysqli_error($conn));
	}

	if($age_range != ''){
		$sql = "update team set `age_range` = $age_range where `team_id` = $id[0]";
		mysqli_query($conn,$sql) or die ('6_Error updating database:  '.mysqli_error($conn));
	}
	mysqli_query($conn,"insert into available value( null,null,null,null,null,null,null,null,null,null,null,null,null,null,now(),$id[0],null)");
	$mess_status = "cancel";
	$message_query ="update message set status ='$mess_status' where sender_id = $user_id[0] and status = 'new' and type = 'join team request'";
	mysqli_query($conn,$message_query)or die('error cancel:' . mysqli_error($conn));

		mysqli_close($conn);
	header("Location: ./team_created.php");
}

if ( isset($_POST["edit_button"]) )
{
	
	header("Location: ./createTeam.php");
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
           <li><a href="createTeam.php"> Create Team</a></li>
           <li>Team Information</li>
      </ul>
		<div class="body">
			<div class="form result">
				<form action="<?php echo $self; ?>" method="post">
					<!-- form table -->
					<table class="table">
						<!-- Team Name -->
						<tr><h1>Create New Team</h1><br></tr>
						<tr>
							<td>Team Name: </td>
							<td>
								<?php echo $team_name; ?>
							</td>
						</tr>
						<!--Location-->
						<tr>
							<td>Team Location:</td>
							<td>
								<?php echo $location; ?>
							</td>
						</tr>
						<!-- Age Range -->
						<tr>
							<td>Age Range:</td>
							<td>
								<?php 
								if($age_range==1)
									echo "Kids";
								else if($age_range==2)
									echo "youth";
								else if($age_range == 3)
									echo "Adult";
								?>
							</td>
						</tr>
						<!-- City -->
						<tr>
							<td>City:</td>
							<td>
								<?php echo $city; ?>
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