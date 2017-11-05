<?php
	session_start();
	$_SESSION["user_id"] = "soumyaricky19";  
	if(!isset($_SESSION["user_id"])) { 
		header('Location: home.html');
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
	
	$query = "select * from movie order by year desc limit 15";
	$result = mysqli_query($conn,$query);
	$list="";
	
    while ($row = mysqli_fetch_array($result)){	
		
		$img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$row['imageUrl']. "' alt='Image not found' title='".$row['title']."' /></a>";
		$img = $img."<div class='detailContainer'><div><span>Price: ".$row['price']."$ &nbsp;&nbsp;&nbsp;Qty: <input type='number' id='qty".$row['movie_id']."' min='1' max='".$row['quantity']."' required></span></div>";
		$img = $img."<div class='cartButton'><button type='button' id='btn".$row['movie_id']."'>Add to Cart</button></div></div>";
		$list=$list."<div class='cover-item'>".$img."</div>";
		//$img = getImage($row["title"]);
		//$query1 = "UPDATE `movie` SET `imageUrl`= '".$img."' WHERE `movie_id` = '".$row['movie_id']."'";
		//mysqli_query($conn,$query1);
		//echo $row['movie_id']."<br>";
    }
	echo $list;
?>
