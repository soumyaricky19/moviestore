<?php
    session_start();
    // if(!isset($_SESSION["user_id"])) { 
    //     header('Location: home.html');
    //     exit();
    // }
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
        $query = "update movie set title='".$title."',description='".$description."',director='".$director."',year='".$year."',imageUrl='".$img."',duration='".$duration."',rating='".$rating."',votes='".$votes."',quantity='".$quantity."',price='".$price."' where  movie_id=".$movie_id;
        echo $query;
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        
        if (!mysqli_query($conn, $query)) {
            $message="update error";
            echo $message;
            return;
        }    
    } 
    else if($op == "add"){
        $query = "insert into `movie`(`title`, `description`, `director`, `year`, `imageUrl`, `duration`, `rating`, `votes`, `quantity`, `price`, `is_available`) VALUES (".$title.",".$description.",".$director.",".$year.",".$img.",".$duration.",".$rating.",".$votes.",".$quantity.",".$price.")";
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        
        if (!mysqli_query($conn, $query)) {
            $message="insert error";
            echo $message;
            return;
        }  
    }
    else {
        $query="delete from cart where user_id='".$user_id."' and movie_id=".$movie_id;
        if (!mysqli_query($conn, $query)) {
            $message="delete error";
            echo $message;
            return;
        }
    }
 
    $message = "Database Updated";
    echo $message;
    
?>
