<?php
    session_start();
    if(!isset($_SESSION["user_id"])) { 
        header('Location: home.html');
        exit();
    }
    $user_id = $_SESSION["user_id"];
    $movie_id = $_POST["movie_id"];
    $quantity = $_POST["quantity"];
    $op = $_POST["operation"];
    

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
        $query="update cart set quantity=".$quantity." where user_id='".$user_id."' and movie_id=".$movie_id;
        $result = mysqli_query($conn,$query);
        if (!mysqli_query($conn, $query)) {
            $err_message="update error";
        }    
    } 
    else {
        $query="delete from cart where user_id='".$user_id."' and movie_id=".$movie_id;
        $result = mysqli_query($conn,$query);
        if (!mysqli_query($conn, $query)) {
            $err_message="delete error";
        }
    }
    
	if ($err_message == ""){
        $message = "Cart Updated";
        echo $message;
    }
    else{
        echo $err_message;
    }
?>
