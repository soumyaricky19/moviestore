 <?php
    session_start();
    if(isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }
    //$user_id = "soumya";
    $movie_id = $_POST["movie_id"];
    $quantity = $_POST["quantity"];
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
    
    $cart_query="select * from cart where user_id='".$user_id."' and movie_id=".$movie_id;
    $cart_result=mysqli_query($conn, $cart_query);
    $cart_row = mysqli_fetch_array($cart_result);
    $cart_quantity=$cart_row["quantity"];
    if ($cart_quantity == 0)
    {
        $query="insert into cart values ('".$user_id."',".$movie_id.",".$quantity.")";  
        if (!mysqli_query($conn, $query)) {
                $err_message="insert error";
        }    
    }
    else
    {    
        $quantity=$quantity+$cart_quantity;
        $movie_query="select * from movie where is_available=1 and movie_id=".$movie_id;
        $movie_result=mysqli_query($conn, $movie_query);
        $movie_row = mysqli_fetch_array($movie_result);
        $movie_quantity=$movie_row["quantity"];
        if ($movie_quantity < $quantity)
        {
            $err_message=$quantity." quantity not available. Available=".$movie_quantity;
        }
        else
        {
            $query="update cart set quantity=".$quantity." where user_id='".$user_id."' and movie_id=".$movie_id;
            if (!mysqli_query($conn, $query)) {
                $err_message="update error";
            }
        }  
    }
    //echo $query;
    if ($err_message == "")
    {
        $message = "Added to cart";
        echo $message;
    }
    else
    {
        echo $err_message;
    }
?>