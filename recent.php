<?php
	session_start();
	$_SESSION["user_id"] = "admin";  
	// if(!isset($_SESSION["user_id"])) { 
	// 	header('Location: home.html');
	// 	exit();
	// }

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
	
	$query = "select * from movie where is_available = 1 order by year desc limit 15";
	$result = mysqli_query($conn,$query);
	$list="";
	
    while ($row = mysqli_fetch_array($result)){		
		$img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$row['imageUrl']. "' alt='Image not found' title='".$row['title']."' /></a>";		
		if($_SESSION["user_id"] == "admin"){
			$img = $img."<div class='adminButton'><button id='updateBtn".$row['movie_id']."' type ='button' class='btn btn-success'>Update</button>&nbsp;&nbsp;&nbsp;";
			$img = $img."<button id='deleteBtn".$row['movie_id']."' type ='button' class='btn btn-danger'>Delete</button></div>";
		} else{
			$img = $img."<div class='detailContainer'><div><span>Price: $".$row['price']." &nbsp;&nbsp;&nbsp;Qty: <input type='number' id='qty".$row['movie_id']."' min='1' max='".$row['quantity']."' required></span></div>";
			$img = $img."<div class='cartButton'><button type='button' id='btn".$row['movie_id']."'>Add to Cart</button></div></div>";
		}
		$list=$list."<div class='cover-item'>".$img."</div>";	
	}
	echo json_encode(array("content" => $list, "user" => $_SESSION["user_id"]));
	//echo $list;
?>
