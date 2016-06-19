<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	
	include('database.php');
	session_start();

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	//$dbpass = "";
	$dbname = "myDB";


	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	$row = mysqli_fetch_assoc($result);

	$userid = $row[id];

	echo "<h1>Welcome, " .$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p> <label></label> <textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$row[id]'>";
	echo "<p> <input type='submit'> </p>";
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");

	$num_of_rows = mysqli_num_rows($result_posts);
	echo"<h2>My Feed</h2>";

	if ($num_of_rows == 0){
		echo "<p>No new posts to show!</p>";
	}

	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		echo "$row[2] said $row[3] ($row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'></form>";
		echo "<br>";

		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$row[0]'");

		$num_of_coms = mysqli_num_rows($result_comments);

		for($j = 0; $j < $num_of_coms; $j++){
			$row2 = mysqli_fetch_row($result_comments);

			echo "$row2[2] commented $row2[3]";
			echo "<br>";
		}
		echo "<form method='POST' action='comments.php'>";
		echo "<label></label> <textarea name='content'>Leave a comment...</textarea> <br>";
		echo "<input type='hidden' name='UID' value='$userid'>";
		echo "<input type='hidden' name='post_id' value='$row[0]'>";
		echo "<p> <input type='submit'> </p>";
		echo "</form>";
		echo "<br>";
	}

?>

</body>
</html>
