<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
    $session_cart=$_SESSION["session_cart"];
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

    $updated_session_cart=array(array());
    $cart_row=array();
    if($op == "delete") {
        if ($user_id != "guest") {
            $cart_query="delete from cart where user_id='".$user_id."' and movie_id=".$movie_id;
            if (!mysqli_query($conn, $cart_query)) {
                $message="delete error";
                echo json_encode(array("message" => $message));         
                return;
            }
        }
        else {
            foreach($session_cart as $item){
                if ($item['movie_id'] != $movie_id){
                    array_push($updated_session_cart,$item);
                }
            }
        }
    } 
    else
    {
        $cart_quantity=0;
        if ($user_id != "guest") {
            $cart_query="select * from cart where user_id='".$user_id."' and movie_id=".$movie_id;
            $cart_result=mysqli_query($conn, $cart_query);
            $cart_row = mysqli_fetch_array($cart_result);
        }   
        else {
            foreach($session_cart as $item){
                if ($item['movie_id'] == $movie_id){
                    $cart_row=$item;
                }
            }
        }
        $cart_quantity=$cart_row["quantity"];
        $requested_quantity=$quantity+$cart_quantity;
        
        if ($op == "update") {
            $requested_quantity=$quantity;
        }
        $movie_query="select * from movie where is_available=1 and movie_id=".$movie_id;
        $movie_result=mysqli_query($conn, $movie_query);
        $movie_row = mysqli_fetch_array($movie_result);
        $movie_quantity=$movie_row["quantity"];
        $movie_price=$movie_row["price"];
        $movie_title=$movie_row["title"];
        if ($movie_quantity < $requested_quantity)
        {
            $message=$requested_quantity.' quantity of "'.$movie_title.'" not available. Available quantity='.$movie_quantity;
            //echo $message;
            echo json_encode(array("message" => $message));          
            return;
        }
        $updated_price=$requested_quantity*$movie_price;
        if ($cart_quantity == 0) {
            if ($user_id != "guest") {
                $cart_query="insert into cart values ('".$user_id."',".$movie_id.",".$requested_quantity.",".$updated_price.")"; 
                if (!mysqli_query($conn, $cart_query)) {
                    $message="insert error";
                    echo json_encode(array("message" => $message));     
                    return;
                }    
            }
            else {
                $new_row = array('movie_id' => $movie_id, 'requested_quantity' => $requested_quantity, 'updated_price' => $updated_price);
                array_push($updated_session_cart,$new_row);
            }
        }
        else {  
            if ($user_id != "guest") {
                $cart_query="update cart set quantity=".$requested_quantity.",price=".$updated_price." where user_id='".$user_id."' and movie_id=".$movie_id;
                if (!mysqli_query($conn, $cart_query)) {
                    $message="update error";
                    echo json_encode(array("message" => $message));
                    return;
                }
            }
            else {
                foreach($session_cart as $item) {
                    if ($item['movie_id'] == $movie_id){
                        $item['requested_quantity']=$requested_quantity;
                        $item['updated_price']=$updated_price;
                    }
                    array_push($updated_session_cart,$item);
                }
            }
        }
    }
    $_SESSION["session_cart"]=$updated_session_cart;
    $message = "Cart Updated";
    echo json_encode(array("message" => $message, "price" => $updated_price));
    
?>
