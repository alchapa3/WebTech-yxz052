<?php

	session_start();

	include('database.php');
	include('functions.php');
	//get data from the form
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['Name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$vquestion = $_POST['verification_question'];
	$vanswer = $_POST['verification_answer'];
	$location = $_POST['location'];
	$propic = $_POST['profile_pic'];


	//connect to DB
	$conn = connect_db();

	//hash the password prior to inserting 
	$cpassword = crypt('$password','$6$rounds=5000$a0z1b9y2c8x3d7w4$');

	//sanitize prior to insertion
	$username = sanitizeString($conn, $username);
	$cpassword = sanitizeString($conn, $cpassword);
	$name = sanitizeString($conn, $name);
	$email = sanitizeString($conn, $email);
	$dob = sanitizeString($conn, $dob);
	$gender = sanitizeString($conn, $gender);
	$vquestion = sanitizeString($conn, $vquestion);
	$vanswer = sanitizeString($conn, $vanswer);
	$location = sanitizeString($conn, $location);
	$propic = sanitizeString($conn, $propic);


	$result_insert = mysqli_query($conn, "INSERT INTO users(username, password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', '$cpassword', '$name', '$email', '$dob', '$gender', '$vquestion', '$vanswer', '$location', '$propic')");

	//check if insert was ok
	if($result_insert){
		//redirect to feed page
		$_SESSION["username"] = $username;
		header("Location: feed.php");
	}else{
		// throw an error
		echo "Oops! Something went wrong! Please try again!";
	}


?>