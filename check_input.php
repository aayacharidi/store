<?php
session_start();


	$self = $_SERVER['REQUEST_URI'];
	$f_name=htmlentities($_SESSION['f_name']);
	$l_name=htmlentities($_SESSION['l_name']);
	$user_name=htmlentities($_SESSION['user_name']);
	$email=htmlentities($_SESSION['email']);
	$password=$_SESSION['password'];
	$dob=htmlentities($_SESSION['dob']);
	$gender=$_SESSION['gender'];
	$city=$_SESSION['city'];
?>
<?php
	if ( isset($_POST['submit_button']) )
	{
		require 'basic/mysqli_conn.php'; 
	$_SESSION['login_user'] = $user_name;
	$id = mysqli_fetch_array(mysqli_query($conn,"select max(user_id)+1 from user")) or die ('Database Error: '.mysqli_error($conn));
	if(!isset($id[0])){
		$id[0]=1;
	}
	$sql = "INSERT INTO `user` (user_id, user_name, password, f_name, l_name, nickname, email, phone, gender, city, dob, height, weight, team_id) 
	VALUES ( $id[0] , '$user_name', md5('$password'), '$f_name', '$l_name', null, '$email', null , '$gender', '$city', '$dob', null, null, null ) ;";

	mysqli_query($conn,$sql) or die ('Database Error not able to create a user: '.mysqli_error($conn));
	mysqli_query($conn,"insert into available value( null,null,null,null,null,null,null,null,null,null,null,null,null,null,now(),null,$id[0])");
	mysqli_close($conn);
	
	header("Location: ./account_created.php");
	exit;
	}

	if ( isset($_POST['edit_button']) )
	{
	
		header("Location: ./SignUp.php");
		exit;
	}


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePage_Style.css">
	<link rel="stylesheet" type="text/css" href="CreateAccount_Style.css">
	<link rel="icon" type="image/png" href="img/S63_old.png">
	<title>Sport Event Management</title>
	<style type="text/css">
		
		nav{
   			 border-radius: 0px 0px 12px 12px ;
			}
	</style>
</head>
<body>

	
	<div class="body_back">
		<?php
			include 'basic/navigation.php';
		?>
		<div class="body">
			<div class="form result">
				<form action="<?php echo $self ?>" method="post">
					<h1>Your Information</h1>
						<table class="table">
						<!-- First Name -->
						<tr>
							<td>First Name: </td>
							<td>
								<?php echo $f_name; ?>
							</td>
						</tr>
						<!--Last Name-->
						<tr>
							<td>Last Name:</td>
							<td>
								<?php echo $l_name; ?>
							</td>
						</tr>
						<!-- New User Name -->
						<tr>
							<td>New User Name:</td>
							<td>
								<?php echo $user_name; ?>
							</td>
						</tr>
						<!-- Email Address -->
						<tr>
							<td>Email Address:</td>
							<td>
								<?php echo $email; ?>
							</td>
						</tr>
						<!-- Gender -->
						<tr>
							<td>Gender: </td>
							<td>
							<?php 
								if ($gender == 'm') echo "Male"; 
								else echo "Female";
							?>
							</td>
						</tr>
						<!-- Birthday -->
						<tr>
							<td>Birthday:</td>
							<td> 
								<?php echo $dob ?> 
							</td>
						</tr>
						<!-- City -->
						<tr>
							<td>City:</td>
							<td>
								<?php echo $city ?>	
							</td>
						</tr>
						</table>	
								 
						
						<!-- create account button -->
								<p>
									<input type="submit" name="submit_button" value="Agree"> 
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
