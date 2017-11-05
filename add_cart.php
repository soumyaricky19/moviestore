 <?php
    session_start();
    // if(!isset($_SESSION["user_id"])) { 
    //     header('Location: home.html');
    //     exit();
    // }
    $user_id = $_SESSION["user_id"];
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
    $requested_quantity=$quantity+$cart_quantity;
    $movie_query="select * from movie where is_available=1 and movie_id=".$movie_id;
    $movie_result=mysqli_query($conn, $movie_query);
    $movie_row = mysqli_fetch_array($movie_result);
    $movie_quantity=$movie_row["quantity"];
    $movie_title=$movie_row["title"];
    $movie_price=$movie_row["price"];
    if ($movie_quantity < $requested_quantity)
    {
        $message=$requested_quantity.' quantity of "'.$movie_title.'" not available. Available quantity='.$movie_quantity;
        echo $message;
        return;
    }
    else{
        $updated_price=$requested_quantity*$movie_price;
        if ($cart_quantity == 0) {
        $query="insert into cart values ('".$user_id."',".$movie_id.",".$requested_quantity.",".$updated_price.")";  
            if (!mysqli_query($conn, $query)) {
                    $message="insert error";
                    echo $message;
                    return;
            }    
        }
        else {    
            $query="update cart set quantity=".$requested_quantity.",price=".$updated_price." where user_id='".$user_id."' and movie_id=".$movie_id;
            if (!mysqli_query($conn, $query)) {
                $message="update error";
                echo $message;
                return;
            }
        }
    }
    $message="Added to cart";
    echo $message;
?>