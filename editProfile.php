
<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');

if ( isset($_POST['saveButton']) )
	process_form();
elseif ( isset($_POST['cancelButton']) )
{
	header("Location: ./myProfile.php");
}
else
	display_form('');


function display_form( $error )
{
	require('basic/mysqli_conn.php'); 
	require('basic/loginTest.php');
	require('basic/profileColumns.php'); 

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
		<link rel="stylesheet" type="text/css" href="editProfileStyle.css">
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
				<li>My Profile</li>
			</ul>
			<div class="body">

				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
					<div class="board">
						<table>
							<th>
								<td><h1 id="title">Edit Profile</h1></td>
							</th>
							<tr>
								<td class="board_left">Name: <?php echo $myProfile_col['fullname']; ?></td>
								<td class="board_left">Team Name:   <?php if($is_null != 0) {echo $profile_teamName['team_name'];} ?>
							</td>
							
						</tr>
						<tr>
							<td class="board_left">Nickname: (15 characters) 
								<input class="input" type="text" name="nickname" value="<?php echo $myProfile_col['nickname']; ?>" placeholder="new nickname" size="15">
								<br>
								<div style="color: red; font-size: 15px;">
									<?php if (isset($error[0]))
									echo    str_repeat('&nbsp;', 3) . $error[0];
									?>
								</div>
							</td>
							<td class="board_left">Gender: <br>

								<input type="radio" name="gender" value="m" <?php if ($myProfile_col['gender']=="m") echo "checked";?>> Male
								<input type="radio" name="gender" value="f" <?php if ($myProfile_col['gender']=="f") echo "checked";?>> Female 	

							</td>
						</tr>
						<tr>													<!-- php echo $myProfile_col['dob'];  -->
							<td class="board_left">Date of Birth:  
								<input class="input" type="Date" name="dob" value="<?php echo $myProfile_col['dob']; ?>">
							</td>
							<td class="board_right">Email Address: &nbsp;&nbsp; <br>
								<input class="input" type="email" name="email" size="50" value="<?php echo $myProfile_col['email']; ?>">
								<div style="color: red; font-size: 15px;">
									<?php if (isset($error[3]))
									echo   str_repeat('&nbsp;', 3) . $error[3];
									?>
								</td>
							</tr>
							<tr>
								<td class="board_left">Phone Number:  
									<input class="input" type="text" name="phone" size="15" value="<?php echo $myProfile_col['phone']; ?>">
									<br>(in 20 digits)
									<div style="color: red; font-size: 15px;">
										<?php if (isset($error[1]) || isset($error[2])){
											echo   str_repeat('&nbsp;', 3) . $error[1];
											echo "<br>";
											echo   str_repeat('&nbsp;', 3) . $error[2];
										}


										?>
										<div>
										</td>
									</tr>
									<tr>
										<td class="board_left">Height: (cm)  
											<input class="input" type="text" name="height" size="5" value="<?php echo $myProfile_col['height']; ?>"> 
											<div style="color: red; font-size: 15px;">
												<?php if (isset($error[6]))
												echo    str_repeat('&nbsp;', 3) . $error[6];
												?>
											</div>
										</td>
										<td class="board_right">Weight: (kg) 
											<input class="input" type="text" name="weight" size="5" value="<?php echo $myProfile_col['weight']; ?>"> 
											<div style="color: red; font-size: 15px;">
												<?php if (isset($error[7]))
												echo    str_repeat('&nbsp;', 3) . $error[7];
												?>
											</div>
										</td>
									</tr>
									<tr>

										<td class="board_right">Jersey:  
											#<input class="input" type="text" name="jersey" size="5" value="<?php echo $myProfile_col['jersey_no']; ?>">
											<div style="color: red; font-size: 15px;">
												<?php 
												if (isset($error[4]) || isset($error[5])) 
												{
													echo  str_repeat('&nbsp;', 3) . $error[4];
													echo "<br>";
													echo  str_repeat('&nbsp;', 3) . $error[5];
												}
												?>
												<div>

												</td>
												<td class="board_left">Position:  
													<!-- <input type="text" name="position" size="5" value="php echo $myProfile_col['position']; "> -->
													<select class="input" name ="position" style="width: 150px;">
														<option value="PG"
														<?php if ( $myProfile_col['position'] == 'PG') { ?> selected="selected" <?php } ?> >PG</option>
														<option value="SG"
														<?php if ( $myProfile_col['position'] == 'SG') { ?> selected="selected" <?php } ?> >SG</option>
														<option value="SF" 
														<?php if ( $myProfile_col['position'] == 'SF') { ?> selected="selected" <?php } ?> >SF</option>
														<option value="PF"
														<?php if ( $myProfile_col['position'] == 'PF') { ?> selected="selected" <?php } ?> >PF</option>
														<option value="C"
														<?php if ( $myProfile_col['position'] == 'C') { ?> selected="selected" <?php } ?> >C </option>
													</select>
												</td>
											</tr>
										</table>
									</div>
									<input class="submitButton" type="submit" name="saveButton" value="Save">
									<input class="submitButton" type="submit" name="cancelButton" value="Cancel">
								</form>




							</div>
							<?php
							include 'basic/bottom.php';
							?>
						</div>

					</body>
					</html>

					<?php
				}
				?>


				<?php

function process_form(){	
	require('basic/mysqli_conn.php'); 
	require('basic/loginTest.php');

	$error = validate_form();

	if ( $error[8] )
		display_form( $error);
	else
	{

		$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
		$nickname = htmlentities($nickname);//in case someone try to insert html in the dataabse
		 mysqli_query($conn, "UPDATE `user` 
			SET `nickname` = '$nickname' 
			WHERE user_id = '$user_id' ") or die('database error(nickname): '. mysqli_error($conn) );

							$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
	$gender = htmlentities($gender);//in case someone try to insert html in the dataabse
	 mysqli_query($conn, "UPDATE `user` 
		SET `gender` = '$gender' 
		WHERE user_id = '$user_id' ") or die('database error(gender): '. mysqli_error($conn) );

	$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
	$dob = htmlentities($dob);//in case someone try to insert html in the dataabse
	 mysqli_query($conn, "UPDATE `user` 
		SET `dob` = '$dob' 
		WHERE user_id = '$user_id' ") or die('database error(dob): '. mysqli_error($conn) );

	if ( $_POST['height'] == '' )
		 mysqli_query($conn, "UPDATE `user` 
			SET `height` = null 
			WHERE user_id = '$user_id' ") or die('database error(height): '. mysqli_error($conn) );		
	else
	{
		$height = isset($_POST['height']) ? $_POST['height'] : '';
		$height = htmlentities($height);//in case someone try to insert html in the dataabse
		 mysqli_query($conn, "UPDATE `user` 
			SET `height` = '$height' 
			WHERE user_id = '$user_id' ") or die('database error(height): '. mysqli_error($conn) );
	}

	if ( $_POST['weight'] == '' )
	{
		 mysqli_query($conn, "UPDATE `user` 
			SET `weight` = null 
			WHERE user_id = '$user_id' ") or die('database error(weight): '. mysqli_error($conn) );	
	}
	else
	{
		$weight = isset($_POST['weight']) ? $_POST['weight'] : '';
		$weight = htmlentities($weight);//in case someone try to insert html in the dataabse
		 mysqli_query($conn, "UPDATE `user` 
			SET `weight` = '$weight' 
			WHERE user_id = '$user_id' ") or die('database error(weight): '. mysqli_error($conn) );
	}

	if ( $_POST['jersey'] == '' )
	{
		 mysqli_query($conn, "UPDATE `user` 
			SET `jersey_no` = null 
			WHERE user_id = '$user_id' ") or die('database error(jersey): '. mysqli_error($conn) );	
	}
	else
	{
		$jersey = isset($_POST['jersey']) ? $_POST['jersey'] : '';
		$jersey = htmlentities($jersey);//in case someone try to insert html in the dataabse
		 mysqli_query($conn, "UPDATE `user` 
			SET `jersey_no` = '$jersey' 
			WHERE user_id = '$user_id' ") or die('database error(jersey): '. mysqli_error($conn) );
	}


	$position = isset($_POST['position']) ? $_POST['position'] : '';
	$position = htmlentities($position);//in case someone try to insert html in the dataabse
	 mysqli_query($conn, "UPDATE `user` 
		SET `position` = '$position' 
		WHERE user_id = '$user_id' ") or die('database error(position): '. mysqli_error($conn) );

	if ( $_POST['phone'] == '' )
	{
		 mysqli_query($conn, "UPDATE `user` 
			SET `phone` = null 
			WHERE user_id = '$user_id' ") or die('database error(phone): '. mysqli_error($conn) );	
	}
	else{
		$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
		$phone = htmlentities($phone);//in case someone try to insert html in the dataabse
		 mysqli_query($conn, "UPDATE `user` 
			SET `phone` = '$phone' 
			WHERE user_id = '$user_id' ") or die('database error(phone): '. mysqli_error($conn) );
	}


	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$email = htmlentities($email);//in case someone try to insert html in the dataabse
	 mysqli_query($conn, "UPDATE `user` 
		SET `email` = '$email' 
		WHERE user_id = '$user_id' ") or die('database error(email): '. mysqli_error($conn) );

	display_result();
}
}	
?>

<?php
function validate_form() 
{
	$error = array_fill(0,10,null);
	$error[8] = false;

	if ( strlen($_POST['nickname']) > 15 ){
		$error[0] .= "* nickname cannot exceed 15 characters.";
		$error[8] = true;
	}

	if ( strlen($_POST['phone']) > 20 ){
		$error[1] .= "* phone number cannot exceed 20 digits.";
		$error[8] = true;
	}

	if( preg_match("/[a-z][A-Z]/i", $_POST['phone']) ){
		$error[2] .= "* phone number cannot cantain letters." ;
		$error[8] = true;
	}

	if( $_POST['email'] == ''){
		$error[3] .= "* email address cannot be empty.";
		$error[8] = true;
	}

	if( !is_numeric($_POST['jersey']) || $_POST['jersey'] < 0 || $_POST['jersey'] != round($_POST['jersey']) ){
		$error[4] .= "* jersey number only allow positive number.";
		$error[8] = true;
	}
	if( strlen($_POST['jersey']) > 5 ){
		$error[5] .= "* jersey number cannot input more than 5 digits.";
		$error[8] = true;
	}
	if( !is_numeric($_POST['height']) || $_POST['height'] < 0 ){
		$error[6] .= "* height only can input non-negative numbers.";
		$error[8] = true;
	}
	if( !is_numeric($_POST['weight']) || $_POST['weight'] < 0 ){
		$error[7] .= "* weight only can input non-negative numbers.";
		$error[8] = true;
	}


	return $error;
}
?>


<?php
function display_result()
{ 
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
		<link rel="stylesheet" type="text/css" href="CreateAccount_Style.css">
		<title>Sport Event Management</title>
	</head>
	<body>


		<div class="body_back">
			<?php
			include 'basic/navigation.php';
			?>
			<div class="body">
				<div class="form result">
					<table>
						<tr>
							<td><img style="width: 500px;" src=".\img\done.png"></td>
						</tr>
						<tr>
							<td><p style="color: rgb(255,255,255);">
								Your profile renewed! <br>
								<a href="./myProfile.php">Go Back</a>

							</p></td>
						</tr>
					</table>
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
?>


<?php
mysqli_close($conn);
?>

























