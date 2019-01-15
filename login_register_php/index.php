<?php 

	// Including Database Connection
	include_once 'db.php';
	session_start();
	// Checking Whether User is Logged in or Not..
	if(isset($_SESSION['user']))
	{
		header('Location: home.php');
		exit;
	}

	// Submitting Login Form
	$error = false;
	$email_error = $pass_error = '';

	// If Login Button is Pressed
	if(isset($_POST['login-submit']))
	{
		$u_email = trim($_POST['u_email']);		
		$u_email = strip_tags($u_email);
		$u_email = htmlspecialchars($u_email);

		$u_pwd = trim($_POST['u_pwd']);		
		$u_pwd = strip_tags($u_pwd);
		$u_pwd = htmlspecialchars($u_pwd);

		// Email Validation
		if(empty($u_email)) {
			$error = true;
			$email_error = 'Please Provide Email..';
		}
		else if (!filter_var($u_email,FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$email_error = "Please Enter Valid Email Address..";
		}

		// Password Validation
		if(empty($u_pwd)) {
			$error = true;
			$pass_error = 'Please Enter Password..';
		}

		// If All Validation Are True
		if(!$error)
		{
			// Hashing the Password
			$hashed_password = password_hash($u_pwd, PASSWORD_DEFAULT); 

			$sql = "SELECT * FROM users WHERE useremail = '$u_email'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
			$result = mysqli_num_rows($query);

			if($result == 1 && password_verify($u_pwd, $row['userpass']))
			{
				$_SESSION['user'] = $row['id'];
				header("Location: home.php");
			} 
			else {
				$error_msg = 'Invalid Credentials...';
			}
		}   
	}
?>

<!-- Login Form -->
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-4 text-center">				
				<h1 style="margin:150px 0 20px;">Login Form</h1>
				<?php
				if (isset($error_msg) ) {
				?>
					<div class="form-group">
		            	<div class="alert alert-danger">
							<span class="glyphicon glyphicon-info-sign"></span> <?php echo $error_msg; ?>
		            	</div>
		           	</div>
	         	<?php
				}
				?>
				<form class="text-left" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
					<div class="form-group">						
						<label for="u_email">Email</label>
						<input type="text" name="u_email" class="form-control">
						<span class="text-danger"><?php echo $email_error; ?></span>
					</div>
					<div class="form-group">
						<label for="u_pwd">Password</label>
						<input type="password" name="u_pwd" class="form-control">	
						<span class="text-danger"><?php echo $pass_error; ?></span>
					</div>
					<div class="form-group">
						<button type="submit" name="login-submit" class="btn btn-primary" value="submit">Login</button>
					</div>
				</form>
				<p class="text-left"><a href="register.php">Not Registred? Create Account...</a></p>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-md-12 text-center">
				<footer>Copyright &copy; 2019, <a href="http://www.codejugaads.blogspot.com" target="_blank">Codejugaad.com</a> <b>Hardik HLR Gohil</b>.</footer>					
			</div>
		</div>
	</div>
</body>
</html>