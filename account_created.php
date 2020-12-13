<?php
session_start();
require("basic/mysqli_conn.php"); 


require("basic/loginTest.php");
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
			require("basic/navigation.php");
		?>
		<div class="body">
			<div class="form result">
				<table>
					<tr>
						<td><img style="width: 400px;" src=".\img\done.png"></td>
					</tr>
					<tr>
						<td><p style="color: #ffff;">
							You have created a new account successfully!! <br>
							you can check your profile and add more information: <br><a href="myProfile.php">click here</a>

						</p></td>
					</tr>
				</table>
			</div>
		</div>
		<?php
			require("basic/bottom.php");
		?>
	</div>
	
</body>
</html>