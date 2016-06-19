<?php

	session_start();
	//get username and password from $_POST
	$username = $_POST["username"];
	$password = $_POST["password"];

	$cpassword = crypt('$password','$6$rounds=5000$a0z1b9y2c8x3d7w4$');


	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "myDB";


	$conn = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);
	if(mysqli_connect_errno($conn)){
	echo "Failed to connect to MySql: " . mysqli_connect_error();
	}

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$cpassword'");

	$num_of_rows = mysqli_num_rows($result);

	if($num_of_rows > 0){
		$_SESSION["username"] = $username;
		header("Location: feed.php");

	}else{
		//ask to login again
		echo "Invalid password";
	}

	//If authenticated: say hello!

	//else ask to login again..




?>