 <?php
    session_start();
    if(!isset($_SESSION["user_id"])) { 
        header('Location: home.html');
        exit();
    }
    $user_id = $_SESSION["user_id"];
    if ($user_id == "guest")
    {
        $message="Please login";
        echo $message;
        return;
    }

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
        $movie_title=$movie_row["title"];
        if ($movie_quantity < $cart_quantity)
        {
            $message=$cart_quantity.' quantity of "'.$movie_title.'" not available. Available quantity='.$movie_quantity;
            echo $message;
            return;
        }
        
        $shipping_id_ok=0;
        do{
            $shipping_id=rand(1, 99999999);
            $shipping_query="select * from purchases where shipping_id=".$shipping_id;
            $shipping_result=mysqli_query($conn, $shipping_query);
            $shipping_row = mysqli_fetch_array($shipping_result);
            if ($shipping_row == ""){
                $shipping_id_ok=1;
            }  
        }
        while ($shipping_id_ok == 0);

        $purchases_query="insert into purchases values ('".$user_id."',".$cart_movie_id.",".$cart_quantity.",'".$shipping_id."',0)"; 
        if (!mysqli_query($conn, $purchases_query)) {
                $message="insert error";
                echo $message;
                return;
        }
    }
    
    $message="Order placed succesfully!";
    echo $message;
?>