<?php
session_start();
require('basic/mysqli_conn.php'); 	
require('basic/loginTest.php');

if ( isset($_POST['submit_button']) )
	process_form();
else	
	display_form('');
function display_form($error)
{	require('basic/mysqli_conn.php');
	require('basic/loginTest.php');
	$self = $_SERVER['REQUEST_URI'];
	$team_name=isset($_POST['team_name']) ? $_POST['team_name'] :'';
	$location=isset($_POST['location']) ? $_POST['location'] :'';
	$city=isset($_POST['city']) ? $_POST['city'] :'';
	$age_range=isset($_POST['age_range']) ? $_POST['age_range'] :'';	

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
           <li>Create Team</li>
      </ul>
			<div class="body">
				<div class="form f_left">
					<form action="<?php echo $self; ?>" method="post">
						<h1>Create New Team</h1>
						<!-- form table -->
						<table class="table">
							<!-- Team Name -->
							<tr>
								<td>Team Name:<br>
									<?php
									if ( isset($error[0]) )
										echo "<p class = 'error'>".$error[0]."</p>"; ?>
								</td>
								<td><input class="input" type="text" name="team_name" 
									value="<?php echo $team_name?>" placeholder="Your Team Name" >
								</td>
							</tr>
							<!--Location-->
							<tr>
								<td>Team Location(optional): <br>
									<?php
									if ( isset($error[1]) )
										echo "<p class = 'error'>".$error[1]."</p>"; ?>
								</td>
								<td><input class="input" type="text" name="location" 
									value="<?php echo $location ?>" placeholder="Your Team Location" >
								</td>
							</tr>
							<!-- Age Range -->
							<tr>
								<td> Team Age Range (optional):<br>
									<?php
									if ( isset($error[2]) )
										echo "<p class = 'error'>".$error[2]."</p>"; ?>

								</td>
								<td>
									<select class="input" name = "age_range">
										<option value="" > [select] </option>
										<option value="1"<?php if($age_range== 1 ) echo 'selected="selected"'; ?>> Kids </option>
										<option value="2" <?php if($age_range== 2 ) echo 'selected="selected"'; ?>> Youth </option>
										<option value="3" <?php if($age_range== 3 ) echo 'selected="selected"'; ?>> Adult </option>
									</select>
								</td>
							</tr>
							<!-- City -->
							<tr>
								<td>City:<br>
									<?php
									if ( isset($error[3]) )
										echo "<p class = 'error'>".$error[3]."</p>"; ?>

								</td>
								<td>
									<select class="input" name = "city"  >
										<option value=""> [select] </option>
										<option value="Riyadh" <?php if($city=="Riyadh") echo 'selected="selected"'; ?>> Riyadh </option>
										<option value="Jeddah" <?php if($city=="Jeddah") echo 'selected="selected"'; ?>> Jeddah </option>
										<option value="Dammam" <?php if($city=="Dammam") echo 'selected="selected"'; ?>> Dammam </option>
																		</select>
								</td>
							</tr>							
						</table>
						<!-- create account button -->
						<p><input type="submit" name="submit_button" value="Create Team"></p>
					</form>
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

		// check for errors
function validate_form()
{
	require('basic/mysqli_conn.php');
	$error = array_fill(0,4,null);
	$error[4] = false;
			//name should not be numeric and at latest 2 characters
	$team_name=$_POST['team_name'];
	if ( strlen($team_name) < 2) {
		$error[0] .= "* Invalid Team Name! <br>";
		$error[4] = true;
	}
	// user name should be unique!!-------------------------------
	$team_query=mysqli_query($conn,"SELECT team_name FROM team WHERE team_name='".$team_name."'");
	if(mysqli_num_rows($team_query) != 0){
		$error[0] .= "* team name is already exist! <br>";
		$error[4] = true;
	}
			//------------------------------------------------------------
	
	$city = $_POST['city'];
	if($city == ''){
		$error[3] = "* required field!!";
		$error[4] = true;
	}
	return $error;
}
?>
<?php
function process_form()
{
	$error = validate_form();
	if ( $error[4] == true )
		display_form($error);
	else
		display_result();
}
?>
<?php
function display_result()
{



		// Set session variables
	$_SESSION['team_name'] = $_POST['team_name'];
	$_SESSION['location'] = $_POST['location'];
	$_SESSION['age_range'] = $_POST['age_range'];
	$_SESSION['city'] = $_POST['city'];
	header("Location: ./checkTeamInfo.php");
	exit;
}
mysqli_close($conn);
?>