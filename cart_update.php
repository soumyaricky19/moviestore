<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
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
        $movie_query="select * from movie where is_available=1 and movie_id=".$movie_id;
        $movie_result=mysqli_query($conn, $movie_query);
        $movie_row = mysqli_fetch_array($movie_result);
        $movie_quantity=$movie_row["quantity"];
        $movie_price=$movie_row["price"];
        if ($movie_quantity < $quantity)
        {
            $message=$quantity.' quantity of "'.$movie_title.'" not available. Available quantity='.$movie_quantity;
            //echo $message;
            echo json_encode(array("message" => $message));          
            return;
        }
        $updated_price=$movie_price*$quantity;
        $cart_query="update cart set quantity=".$quantity.",price=".$updated_price." where user_id='".$user_id."' and movie_id=".$movie_id;
        if (!mysqli_query($conn, $cart_query)) {
            $message="update error";
            //echo $message;
            echo json_encode(array("message" => $message));     
            return;
        }    
    } 
    else {
        $query="delete from cart where user_id='".$user_id."' and movie_id=".$movie_id;
        if (!mysqli_query($conn, $query)) {
            $message="delete error";
            //echo $message;
            echo json_encode(array("message" => $message));         
            return;
        }
    }
 
    $message = "Cart Updated";
    echo json_encode(array("message" => $message, "price" => $updated_price));
    
?>
