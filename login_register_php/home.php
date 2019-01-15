<?php 

	session_start();
	include_once 'db.php';
	if(!isset($_SESSION['user']))
	{
		header('Location: index.php');
		exit();
	}
	$user = $_SESSION['user'];

	$sql = "SELECT * FROM users WHERE id = '$user'";
	$query = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
?>
	
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
	<div class="container-fluid">		
		<div class="row justify-content-center">
			<div class="col-md-6 text-center">
				<h1 class="mt-5">Welcome <?php echo $row['username']; ?></h1>
				<h2 class="mt-4">Your Email is <?php echo $row['useremail']; ?></h2>
				<a href="logout.php?logout" class="btn mt-3 btn-primary"><i class="fa fa-sign-out-alt"></i> Logout</a>
			</div>
		</div>	
	</div>
</body>
</html>