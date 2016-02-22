<!DOCTYPE html>
<html>

<head>
	<title>Register</title>
</head>

<body>

<?php 

	require 'core.inc.php';

	if(!loggedin()) {
		if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password_confirm'])&&isset($_POST['fullname'])&&isset($_POST['email'])&&isset($_POST['college'])) {
			$username = trim($_POST['username']);
			
			$password = trim($_POST['password']);
			$password_again = trim($_POST['password_confirm']);
			
			$fullname = trim($_POST['fullname']);
			$email = trim($_POST['email']);
			$college = trim($_POST['college']);

			if(!empty($username)&&!empty($password)&&!empty($password_again)&&!empty($fullname)&&!empty($email)&&!empty($college)) {
				if(strlen($username)>30||strlen($fullname)>40||strlen($college)>100||strlen($password)>50||strlen($email)>50) {
					echo 'Please adhere to maxlength of fields.';
				} else {
					if($password!=$password_again) {
						echo 'Passwords do not match.';
					}
					else {
						$password_hash = md5($password);
						
						$query = "SELECT username FROM users WHERE username='".mysqli_real_escape_string($mysql_connect, $username)."'";
						
						$query_run = mysqli_query($mysql_connect, $query);
						$query_num_rows = mysqli_num_rows($query_run);
						
						if($query_num_rows == 1) {
							echo 'The username '.$username.' already exists.';
						} else {
							$query = "INSERT INTO users (username, password, fullname, email, college) VALUES ('".mysqli_real_escape_string($mysql_connect, $username)."','".mysqli_real_escape_string($mysql_connect, $password_hash)."','".mysqli_real_escape_string($mysql_connect, $fullname)."','".mysqli_real_escape_string($mysql_connect, $email)."','".mysqli_real_escape_string($mysql_connect, $college)."')";
							if($query_run = mysqli_query($mysql_connect, $query)) {
								header('Location: register_success.php');
							} else {
								echo 'Sorry, we couldn\'t register you at this time. Try again later.';
							}
						}
					}
				}
			}
			else {
				echo 'All fields are required.';
			}
		}
?>

<form action="register.php" method="POST">

	Username: <br/><input type="text" name="username" maxlength="30" value="<?php if(isset($username)) { echo $username; } ?>"><br/><br/>
	Password: <br/><input type="password" name="password" maxlength="50"><br/><br/>
	Confirm Password: <br/><input type="password" name="password_confirm" maxlength="30"><br/><br/>
	Full Name:<br/><input type="text" name="fullname" maxlength="40" value="<?php if(isset($fullname)) { echo $fullname; } ?>"><br/><br/>
	Email:<br/><input type="text" name="email" maxlength="50" value="<?php if(isset($email)) { echo $email; } ?>"><br/><br/>
	College:<br/><input type="text" name="college" maxlength="100" value="<?php if(isset($college)) { echo $college; } ?>"><br/><br/>
	<input type="submit" value="Register">
</form>

<?php

	} else if(loggedin()) {
		echo 'You\'re already registered and logged in.';
	}
?>


</body>
</html>