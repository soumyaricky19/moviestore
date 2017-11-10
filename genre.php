<?php
	session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db = "onlinemoviestore";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$query = "select * from genre";
	$result = mysqli_query($conn,$query);
	$list="";
	
    while ($row = mysqli_fetch_array($result)){	
		$list=$list."<a href='search_result.php?genre=".$row['genre_id']."'><div class='cover-item'><p>".$row['genre_name']."</p></div></a>";
    }
	echo $list;
?>

