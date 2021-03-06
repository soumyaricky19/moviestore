 <?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
    // echo ("<script>alert('".$user_id."')</script>");
    if ($user_id == "guest") {
        $message="Please login before continuing";
        echo $message;
        return;
    }
    else {
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

        $cart_query="select * from cart where user_id='".$user_id."'";
        $cart_result=mysqli_query($conn, $cart_query);
        while ($cart_row = mysqli_fetch_array($cart_result))
        {
            $cart_quantity=$cart_row["quantity"];
            $cart_movie_id=$cart_row["movie_id"];
            $movie_query="select * from movie where is_available=1 and movie_id=".$cart_movie_id;
            $movie_result=mysqli_query($conn, $movie_query);
            $movie_row = mysqli_fetch_array($movie_result);
            $movie_quantity=$movie_row["quantity"];
            $movie_price=$movie_row["price"];
            $movie_title=$movie_row["title"]; 
            if ($movie_quantity < $cart_quantity)
            {
                $message=$cart_quantity.' quantity of "'.$movie_title.'" not available. Available quantity='.$movie_quantity;
                echo $message;
                return;
            }
            
            $order_id_ok=0;
            do{
                $order_id=rand(1, 99999999);
                $order_query="select * from purchases where user_id='".$user_id."' and movie_id=".$cart_movie_id."and order_id=".$order_id;
                $order_result=mysqli_query($conn, $order_query);
                $order_row = mysqli_fetch_array($order_result);
                if ($order_row == ""){
                    $order_id_ok=1;
                }  
            }
            while ($order_id_ok == 0);
            $updated_price=$cart_quantity*$movie_price;
            $purchases_query="insert into purchases values ('".$user_id."',".$cart_movie_id.",".$cart_quantity.",".$updated_price.",'".$order_id."', CURRENT_TIMESTAMP, 0)"; 
            if (!mysqli_query($conn, $purchases_query)) {
                    $message="purchase insert error";
                    echo $message;
                    return;
            }
            $cart_delete_query="delete from cart where user_id='".$user_id."' and movie_id=".$cart_movie_id; 
            if (!mysqli_query($conn, $cart_delete_query)) {
                    $message="cart delete error";
                    echo $message;
                    return;
            }
            $updated_quantity=$movie_quantity-$cart_quantity;
            $movie_update_query="update movie set quantity=".$updated_quantity." where movie_id=".$cart_movie_id;
            if (!mysqli_query($conn, $movie_update_query)) {
                    $message="update movie error";
                    echo $message;
                    return;
            }
        }
        
        $message="Order placed succesfully!";
        echo $message;
    }  
?>