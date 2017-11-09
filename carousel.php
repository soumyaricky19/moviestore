<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db = "onlinemoviestore";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);
	$_SESSION["user_id"] = "admin";
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
    
    $query = "select * from movie order by year desc limit 5";
	$result = mysqli_query($conn,$query);
	$list="";
	$count = TRUE;
	
    while ($row = mysqli_fetch_array($result)){	

        $poster =  preg_replace('/185/','500',$row['imageUrl']);  
        $img = "<a href='description.php?id=".$row['movie_id']."'><img src='" .$poster. "' alt='Image not found' title='".$row['title']."' /></a>";
        $img = $img."<div class='movieDetails'>Movie: <p>".$row['title']."</p>Description: <p>".$row['description']."</p>Director: <p>".$row['director']."</p>Year: <p>".$row['year']."</p>Duration: <p>".$row['duration']." minutes</p></div>";
		
		if($_SESSION["user_id"] == "admin"){
			$button = "<div class='adminButton'><button id='updateBtn".$row['movie_id']."' type ='button' class='btn btn-success'>Update</button>&nbsp;&nbsp;&nbsp;";
			$button = $button."<button id='deleteBtn".$row['movie_id']."' type ='button' class='btn btn-danger'>Delete</button></div>";
			$img = $img.$button;	
		}
		
		if($count == TRUE){
            $list = $list."<div class='item active'>".$img."</div>";
        } else{
            $list = $list."<div class='item'>".$img."</div>";
        }
		$count = FALSE;
	}   
	echo $list;
?>
                     
              

