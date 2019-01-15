<?php 

	// Setting Up Connection
	$conn = mysqli_connect('localhost','root','','login') or die("Not connected.");;
	if(!$conn)
	{
		echo "Database Connection Not Established";
	}
?>