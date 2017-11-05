<?php
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
	
	$query="select * from movie order by votes limit 15";
	$result = mysqli_query($conn,$query);
	$list="";

    while ($row = mysqli_fetch_array($result)){
		//$img = getImage($row["title"]);
		//<a href="description.php?id='.$row["movie_id"].'"></a>
		//$img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$row['imageUrl']. "' alt='Image not found' title='".$row['title']."' /></a>";
		//$list=$list."<div class='cover-item'>".$img."</div>";
		$img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$row['imageUrl']. "' alt='Image not found' title='".$row['title']."' /></a>";
		$img = $img."<div class='detailContainer'><div><span>Price: $".$row['price']." &nbsp;&nbsp;&nbsp;Qty: <input type='number' id='qty".$row['movie_id']."' min='1' max='".$row['quantity']."' required></span></div>";
		$img = $img."<div class='cartButton'><button type='button' id='btn".$row['movie_id']."'>Add to Cart</button></div></div>";
		$list=$list."<div class='cover-item'>".$img."</div>";
		
    }
    echo $list;
?>