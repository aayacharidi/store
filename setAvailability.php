<?php
session_start();
require('basic/mysqli_conn.php'); 
require('basic/loginTest.php');
	$ava_query = mysqli_query($conn,"select * from available where user_id = $user_id");
	$self = $_SERVER['REQUEST_URI'];
	if($ava_query <> '')
		$available = mysqli_fetch_array($ava_query);
		isset($available['Mon_from']) ? $available['Mon_from'] :'';
		$mon_from=isset($available['Mon_from']) ? $available['Mon_from'] :'';
		$mon_to=isset($available['Mon_to']) ? $available['Mon_to'] :'';	
		$tue_from=isset($available['Mon_from']) ? $available['Tue_from'] :'';
		$tue_to=isset($available['Tue_to']) ? $available['Tue_to'] :'';	
		$wed_from=isset($available['Wed_from']) ? $available['Wed_from'] :'';
		$wed_to=isset($available['Wed_to']) ? $available['Wed_to'] :'';	
		$thur_from=isset($available['Thur_from']) ? $available['Thur_from'] :'';
		$thur_to=isset($available['Thur_to']) ? $available['Thur_to'] :'';	
		$fri_from=isset($available['Fri_from']) ? $available['Fri_from'] :'';
		$fri_to=isset($available['Fri_to']) ? $available['Fri_to'] :'';	
		$sat_from=isset($available['Sat_from']) ? $available['Sat_from'] :'';
		$sat_to=isset($available['Sat_to']) ? $available['Sat_to'] :'';	
		$sun_from=isset($available['Sun_from']) ? $available['Sun_from'] :'';
		$sun_to=isset($available['Sun_to']) ? $available['Sun_to'] :'';
		

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
           <li><a href="availability.php"> My Availability</a></li>
           <li>Edit</li>
      </ul>
			<div class="body">
				<div class="form f_left">
					<form action="setAva.php"  onsubmit=" return check();">
						<h1>Edit My Availability</h1>
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
									
									<input id="mon_from" class="input_time" type="time" name="mon_from" value="<?php echo $mon_from; ?>" onblur="error('mon_from','mon_to');" >
								</td>
								<td>
									<input id="mon_to" class="input_time " type="time" name="mon_to" value="<?php echo $mon_to ?>" onblur = "error('mon_to','mon_from');">
								</td>
							</tr>
							<!-- Age Range -->
							<tr>
								<td> 
									Tuesday:
								</td>
								<td>
									<input id="tue_from" class="input_time" type="time" name="tue_from" value="<?php echo $tue_from ?>" onblur = "error('tue_from','tue_to');">
								</td>
								<td>
									<input id="tue_to" class="input_time" type="time" name="tue_to" value="<?php echo $tue_to ?>" onblur = "error('tue_to','tue_from');">
								</td>
							</tr>
							<!-- City -->
							<tr>
								<td>
									Wednesday:
								</td>
								<td>
									<input id="wed_from" class="input_time" type="time" name="wed_from" value="<?php echo $wed_from ?>" onblur = "error('wed_from','wed_to');">
								</td>
								<td>
									<input id="wed_to" class="input_time" type="time" name="wed_to" value="<?php echo $wed_to ?>" onblur = "error('wed_to','wed_from');">
								</td>
							</tr>
							<tr>
								<td>
									Thursday:			
								</td>
								<td>
									<input id="thur_from" class="input_time" type="time" name="thur_from" value="<?php echo $thur_from ?>" onblur = "error('thur_from','thur_to');">
								</td>
								<td>
									<input id="thur_to" class="input_time" type="time" name="thur_to" value="<?php echo $thur_to ?>" onblur = "error('thur_to','thur_from');">
								</td>
							</tr>
							<tr>
								<td>
									Friday:	
								</td>
								<td>
									<input id="fri_from" class="input_time" type="time" name="fri_from" value="<?php echo $fri_from ?>" onblur = "error('fri_from','fri_to');">
								</td>
								<td>
									<input id="fri_to" class="input_time" type="time" name="fri_to" value="<?php echo $fri_to ?>" onblur = "error('fri_to','fri_from');">
								</td>
							</tr>
							<tr>
								<td>
									Saturday:
								</td>
								<td>
									<input id="sat_from" class="input_time" type="time" name="sat_from" value="<?php echo $sat_from ?>" onblur = "error('sat_from','sat_to');">
								</td>
								<td>
									<input id="sat_to" class="input_time" type="time" name="sat_to" value="<?php echo $sat_to ?>" onblur = "error('sat_to','sat_from');">
								</td>
							</tr>
							<tr>
								<td>
									Sunday:
								</td>
								<td>
									<input id="sun_from" class="input_time" type="time" name="sun_from" value="<?php echo $sun_from ?>" onblur = "error('sun_from','sun_to');">
								</td>
								<td>
									<input id="sun_to" class="input_time" type="time" name="sun_to" value="<?php echo $sun_to ?>" onblur = "error('sun_to','sun_from');">
								</td>
							</tr>							
						</table>
						<div id="error_text"></div>
						<p><input type="submit" name="submit_button" value="Submit"></p>
					</form>
				</div>				
			</div>
			<?php
			include 'basic/bottom.php';
		?>
		</div>
		<script type="text/javascript">
			
			function error(element,neighbor){
				
				var nei_value = document.getElementById(neighbor).value;
				var ele_value = document.getElementById(element).value;
				
				if(nei_value == '' && ele_value !=''){
					
				document.getElementById(element).style.backgroundColor = "rgb(255,255,255)";
				document.getElementById(neighbor).style.backgroundColor = "rgb(255,0,0,0.5)";
				return false;
				}				
				else if (nei_value != '' && ele_value =='') 
				{
					
				document.getElementById(neighbor).style.backgroundColor = "rgb(255,255,255)";
				document.getElementById(element).style.backgroundColor = "rgb(255,0,0,0.5)";
				return false;
					
				}
				else{
					
				document.getElementById(neighbor).style.backgroundColor = "rgb(255,255,255)";
				document.getElementById(element).style.backgroundColor = "rgb(255,255,255)";
				return true;
				}
			}
			function check(){
				var err_text = "<p class = 'error'>* day with no availability should have both fields 'from' and 'to' empty!! </p>";
				var mon_from = document.getElementById("mon_from").value;
				var mon_to = document.getElementById("mon_to").value;
				if((mon_from == '' && mon_to!= '')||(mon_from != '' && mon_to== '')){
					
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var tue_from = document.getElementById("tue_from").value;
				var tue_to = document.getElementById("tue_to").value;
				if((tue_from == '' && tue_to!= '')||(tue_from != '' && tue_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var wed_from = document.getElementById("wed_from").value;
				var wed_to = document.getElementById("wed_to").value;
				if((wed_from == '' && wed_to!= '')||(wed_from != '' && wed_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var thur_from = document.getElementById("thur_from").value;
				var thur_to = document.getElementById("thur_to").value;
				if((thur_from == '' && thur_to!= '')||(thur_from != '' && thur_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var fri_from = document.getElementById("fri_from").value;
				var fri_to = document.getElementById("fri_to").value;
				if((fri_from == '' && fri_to!= '')||(fri_from != '' && fri_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var sat_from = document.getElementById("sat_from").value;
				var sat_to = document.getElementById("sat_to").value;
				if((sat_from == '' && sat_to!= '')||(sat_from != '' && sat_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}

				var sun_from = document.getElementById("sun_from").value;
				var sun_to = document.getElementById("sun_to").value;
				if((sun_from == '' && sun_to!= '')||(sun_from != '' && sun_to== '')){
					document.getElementById("error_text").innerHTML = err_text;
					return false
				}
				
			}
			
		</script>
	</body>
	</html>
	<?php 

mysqli_close($conn);
?>