<?php 
	include_once 'db.php';

	$user_error = $email_error = $pass_error = '';
	$error = false;
	// If Register Button is Pressed
	if(isset($_POST['btn-register']))
	{
		$u_name = $_POST['u_name'];
		$u_email = $_POST['u_email'];
		$u_pwd = $_POST['u_pwd'];

		// Email Validation
		if(!filter_var($u_email,FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$email_error = 'Invalid Email Address...';
		}
		else if(empty($u_email)) {
			$error = true;
			$email_error = 'Please Enter Email...';
		}
		else {
			$sql = "SELECT useremail FROM users WHERE useremail = '$u_email'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_num_rows($query);
			if($row > 0)
			{
				$error = true;
				$email_error = 'Email Already Exists.';
			} 
		}

		// Username Validation
		if(empty($u_name)) {
			$error = true;
			$user_error = 'Please Enter Username...';
		}
		else if(strlen($u_name) < 5) {
			$error = true;
			$user_error = 'Username Must Have Atleast 5 Characters...';
		}
		
		// Password Validation
		if(empty($u_pwd)) {
			$error = true;
			$pass_error = 'Please Enter Password...';
		}
		else if(strlen($u_pwd) < 6) {
			$error = true;
			$pass_error = 'Password Must Have Atleast 6 Characters...';
		}

		// If All Validation Are True
		if(!$error)
		{
			$hash_password = password_hash($u_pwd, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (username,useremail,userpass) VALUES ('$u_name','$u_email','$hash_password')";
			$query = mysqli_query($conn,$sql);

			if($query) {
				$success_msg = 'Succesfully Registered. <a href="index.php" >Login Here</a>';
			}
			else{
				$error_msg = 'Not Registred';
			}
		}
	}
?>
<!-- Registration Form -->
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">		
		<div class="row justify-content-center">
			<div class="col-md-4">
				<h1 class="text-center" style="margin:150px 0 20px;">Registration Form</h1>
				<?php
				if(isset($error_msg)) {
					?>
					<div class="form-group">
						<div class="alert alert-danger">
							<span class="glyphicon glyphicon-info-sign"></span> <?php echo $error_msg; ?>
						</div>
					</div>
					<?php
				}
				if(isset($success_msg) ) {
					?>
					<div class="form-group">
						<div class="alert alert-success">
							<span class="glyphicon glyphicon-info-sign"></span> <?php echo $success_msg; ?>
						</div>
					</div>
					<?php
				}
				?>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="u_name" class="form-control" autocomplete="off">
						<span class="text-danger"><?php echo $user_error; ?></span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="u_email" class="form-control" autocomplete="off">
						<span class="text-danger"><?php echo $email_error; ?></span>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="u_pwd" class="form-control">
						<span class="text-danger"><?php echo $pass_error; ?></span>
					</div>
					<div class="form-group">
						<button type="submit" name="btn-register" value="Submit" class="btn btn-primary">Submit</button>
					</div>
					<div class="form-group">
						<a href="index.php">Already Have an Account? Login Here</a>
					</div>
				</form>
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