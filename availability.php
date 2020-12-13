<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
	$ava_query =  mysqli_query($conn,"
		select TIME_FORMAT( Mon_from , '%h:%i %p' ) Mon_from 
		, TIME_FORMAT( Mon_to , '%h:%i %p' ) Mon_to
		, TIME_FORMAT( Tue_from , '%h:%i %p' ) Tue_from
		, TIME_FORMAT( Tue_to , '%h:%i %p' ) Tue_to
		, TIME_FORMAT( Wed_from , '%h:%i %p' ) Wed_from
		, TIME_FORMAT( Wed_to , '%h:%i %p' ) Wed_to
		, TIME_FORMAT( Thur_from , '%h:%i %p' ) Thur_from
		, TIME_FORMAT( Thur_to , '%h:%i %p' ) Thur_to
		, TIME_FORMAT( Fri_from , '%h:%i %p' ) Fri_from
		, TIME_FORMAT( Fri_to , '%h:%i %p' ) Fri_to
		, TIME_FORMAT( Sat_from , '%h:%i %p' ) Sat_from
		, TIME_FORMAT( Sat_to , '%h:%i %p' ) Sat_to
		, TIME_FORMAT( Sun_from , '%h:%i %p' ) Sun_from
		, TIME_FORMAT( Sun_to , '%h:%i %p' ) Sun_to
		, renew_data , user_id from available where user_id = $user_id
		");
	if($ava_query<>'')
		$ava = mysqli_fetch_array($ava_query);


	?>
	<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
		<link rel="stylesheet" type="text/css" href="CreateAccount_Style.css">
		<link rel="icon" type="image/png" href="img/S63_old.png">
		<style type="text/css">
		td{
			width: 200px !important;
		}
	</style>
	<title>Sport Event Management</title>
</head>
<body>


	<div class="body_back">
		<?php
		include 'basic/navigation.php';
		?>
		<ul class="breadcrumb">
          <li><a href="homePage.php">Home</a></li>
           <li><a href="myProfile.php"> My Profile</a></li>
           <li>My Availability</li>
      </ul>
		<div class="body">
			<div class="form f_left">
				<form action="setAvailability.php">
					<h1>Availability</h1>
					<!-- form table -->
					<table class="table">
						<!-- Team Name -->
						<tr>
							<td>
								The Day
							</td>
							<td>
								From
							</td>
							<td>
								To
							</td>
						</tr>
						<!--Location-->
						<tr>
							<td>
								Monday:									
							</td>
							<td >
								<?php if (isset($ava['Mon_from']) && $ava['Mon_from']!= '') {
									echo $ava['Mon_from'];
								}
								else{
									echo "____";
								}
									?>
									</td>
								<td>
									<?php if (isset($ava['Mon_to']) && $ava['Mon_to']!= '') {
									echo $ava['Mon_to'];
								}
								else{
									echo "____";
								}
									?>
								
								</td>
								</tr>
								
								<tr>
								<td> 
								Tuesday:
								</td>
								<td>
									<?php if (isset($ava['Tue_from']) && $ava['Tue_from']!= '') {
									echo $ava['Tue_from'];
								}
								else{
									echo "____";
								}
									?>

								</td>
								<td>
									<?php if (isset($ava['Tue_to']) && $ava['Tue_to']!= '') {
									echo $ava['Tue_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>
								<!-- City -->
								<tr>
								<td>
								Wednesday:
								</td>
								<td>
									<?php if (isset($ava['Wed_from']) && $ava['Wed_from']!= '') {
									echo $ava['Wed_from'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								<td>
									<?php if (isset($ava['Wed_to']) && $ava['Wed_to']!= '') {
									echo $ava['Wed_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>
								<tr>
								<td>
								Thursday:			
								</td>
								<td>
									<?php if (isset($ava['Thur_from']) && $ava['Thur_from']!= '') {
									echo $ava['Thur_from'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								<td>
									<?php if (isset($ava['Thur_to']) && $ava['Thur_to']!= '') {
									echo $ava['Thur_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>
								<tr>
								<td>
								Friday:	
								</td>
								<td>
									<?php if (isset($ava['Fri_from']) && $ava['Fri_from']!= '') {
									echo $ava['Fri_from'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								<td>
									<?php if (isset($ava['Fri_to']) && $ava['Fri_to']!= '') {
									echo $ava['Fri_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>
								<tr>
								<td>
								Saturday:
								</td>
								<td>
									<?php if (isset($ava['Sat_from']) && $ava['Sat_from']!= '') {
									echo $ava['Sat_from'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								<td>
									<?php if (isset($ava['Sat_to']) && $ava['Sat_to']!= '') {
									echo $ava['Sat_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>
								<tr>
								<td>
								Sunday:
								</td>
								<td>
									<?php if (isset($ava['Sun_from']) && $ava['Sun_from']!= '') {
									echo $ava['Sun_from'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								<td>
									<?php if (isset($ava['Sun_to']) && $ava['Sun_to']!= '') {
									echo $ava['Sun_to'];
								}
								else{
									echo "____";
								}
									?>
								</td>
								</tr>							
								</table>
								
								<p><input type="submit" name="submit_button" value="Edit"></p>
								</form>
								</div>				
								</div>
								<?php
								include 'basic/bottom.php';
								?>
							</div>
							<script type="text/javascript">


							</script>
						</body>
						</html>
						<?php 
					

					mysqli_close($conn);
					?>