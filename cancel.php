 <?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
    $movie_id= $POST["movie_id"];
    $order_id= $POST["order_id"];
    // $movie_id=3;
    // $order_id=2770997;
    // if ($user_id == "guest")
    // {
    //     $message="Please login";
    //     echo $message;
    //     return;
    // }

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

    $purchases_query="select * from  purchases where user_id='".$user_id."' and movie_id=".$movie_id." and order_id=".$order_id;
    $purchases_result=mysqli_query($conn, $purchases_query);
    $purchases_row=mysqli_fetch_array($purchases_result);
    $purchases_quantity=$purchases_row['quantity']; 

    $purchases_update_query="update purchases set is_cancelled=1 where user_id='".$user_id."' and movie_id=".$movie_id." and order_id=".$order_id;
    if (!mysqli_query($conn, $purchases_update_query)) {
            $message="purchase update error";
            echo $message;
            return;
    }
    $movie_update_query="update movie set quantity=quantity+".$purchases_quantity." where movie_id=".$movie_id;
    if (!mysqli_query($conn, $movie_update_query)) {
            $message="movie update error";
            echo $message;
            return;
    }

    $message="Order cancelled";
    echo $message;
?>