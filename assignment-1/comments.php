<?php

	session_start();

	include('database.php');
	include('functions.php');
	//get data from the form
	$content = $_POST['content'];
	$UID = $_POST['UID'];
	$post_id = $_POST['post_id'];
	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);
	//Fetch user info
	$name = $row["Name"];
	$profile_pic = $row["profile_pic"];


	$content = sanitizeString($conn, $content);


	$result_insert = mysqli_query($conn, "INSERT INTO comments(content, UID, name, profile_pic, likes, post_id) VALUES ('$content', $UID, '$name', '$profile_pic', 0,'$post_id')");

	//check if insert was ok
	if($result_insert){
		//redirect to feed pg
		header("Location: feed.php");
	}else{
		// throw an error
		echo "Oops! Something went wrong! Please try again!";
	}


?>