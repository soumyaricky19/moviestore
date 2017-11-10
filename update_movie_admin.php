<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
    
    $op = $_POST["operation"];
    $movie_id = $_POST["movie_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $director = $_POST["director"];
    $year = $_POST["year"];
    $img = $_POST["image"];
    $duration = $_POST["duration"];
    $rating = $_POST["rating"];
    $votes = $_POST["votes"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];   
    

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

    if($op == "update"){
        $query = "update movie set title=\"".$title."\",description=\"".$description."\",director=\"".$director."\",year=".$year.",imageUrl=\"".$img."\",duration=".$duration.",rating=".$rating.",votes=".$votes.",quantity=".$quantity.",price=".$price." where movie_id=".$movie_id;
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        
        if (!$result) {
            $message=" update error";
            echo $message;
            return;
        }    
    } 
    else if($op == "add"){
        $query = "insert into `movie`(`title`, `description`, `director`, `year`, `imageUrl`, `duration`, `rating`, `votes`, `quantity`, `price`, `is_available`) VALUES (\"".$title."\",\"".$description."\",\"".$director."\",".$year.",\"".$img."\",".$duration.",".$rating.",".$votes.",".$quantity.",".$price.",1)";
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if (!$result) {
            $message="insert error";
            echo $message;
            return;
        }  
    }
    else if($op == "delete"){
        $query="update movie set is_available = 0 where movie_id=".$movie_id;
        $result=mysqli_query($conn, $query);

        if (!$result) {
            $message="delete error";
            echo $message;
            return;
        }
    }
 
    $message = "Database Updated";
    echo $message;
    
?>
