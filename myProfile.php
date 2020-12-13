
<!-- Next part is for connect and determine the user loginin or not, if not, cannot get the profile, 
will move to a page that notice them to sign up. -->
<?php
	session_start();

require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
// The following function is for get the profile information from database

	include 'basic/profileColumns.php'; 
?>

	<!DOCTYPE html>
	<html>
	<head>
	   <link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	   <link rel="stylesheet" type="text/css" href="myProfileStyle.css">
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

	  						<div class="board">
	  							<table>
	  								<th>
	  									<td id="title"> <h1> My Profile </h1> </td>
	  								</th>
	  								<tr>
	  									<td class="board_left">Name: &nbsp;&nbsp; <?php echo $myProfile_col['fullname']; ?></td>
	  									<td class="board_right" rowspan="4"> </td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Nickname: &nbsp;&nbsp; <?php echo $myProfile_col['nickname']; ?></td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Gender:  &nbsp;&nbsp; <?php if( $myProfile_col['gender'] == 'm' )
	  																							echo 'Male'; 
	  																					   elseif ( $myProfile_col['gender'] == 'f' )
	  																					   		echo 'Female';

	  																			     ?>
	  																						
	  									</td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Date of Birth:  &nbsp;&nbsp; <?php echo $myProfile_col['dob']; ?></td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Height:  &nbsp;&nbsp; 
	  										<?php if ( $myProfile_col['height'] != '' )
	  													echo $myProfile_col['height'] . " cm"; 
	  										?>
	  									</td>
	  									<td class="board_right">Weight:  &nbsp;&nbsp; 
	  										<?php if ( $myProfile_col['weight'] != '' )
	  													echo $myProfile_col['weight'] . " kg"; 
	  										?>
	  									</td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Team Name:  &nbsp;&nbsp;

	  										<?php if($is_null == 0) { ?>
	  											<a style="color: red;" href="joinTeam.php"> Join Team</a> or
	  											<a style="color: red;" href="createTeam.php"> Create Team</a>
	  											<?php } 
	  											  else { ?>
													<?php echo $profile_teamName['team_name']; ?></td>
													<?php } ?>
	  									<td class="board_right">Jersey:  &nbsp;&nbsp; <?php echo '#' . $myProfile_col['jersey_no']; ?></td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Position:  &nbsp;&nbsp; <?php echo $myProfile_col['position']; ?></td>
	  								</tr>
	  								<tr>
	  									<td class="board_left">Phone Number:  &nbsp;&nbsp; <?php echo $myProfile_col['phone']; ?></td>
	  									<td class="board_right">Email Address: &nbsp;&nbsp; <?php echo $myProfile_col['email']; ?></td>
	  								</tr>
	  										
	  							</table>
	  						</div>

	  						<a href="./editProfile.php"> <button class="editButton">Edit My Profile</button> </a>
	  						<a href="./availability.php"> <button class="editButton">My Availability</button> </a>



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

