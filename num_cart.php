 <?php
    session_start();
    // if(!isset($_SESSION["user_id"])) { 
    //     header('Location: home.html');
    //     exit();
    // }
    $user_id = $_SESSION["user_id"];
    // $user_id ="soumyaricky19";
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
    
    $cart_query="select sum(quantity) count from cart where user_id='".$user_id."'";
    $cart_result=mysqli_query($conn, $cart_query);
    $cart_row = mysqli_fetch_array($cart_result);
    $count=$cart_row["count"];
    // $count=0;
    // while ($cart_row = mysqli_fetch_array($cart_result))
    // {     
    //     $count+=1;
    // }
    echo $count;
?>