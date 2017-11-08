<?php
    session_start();
    // if(!isset($_SESSION["user_id"])) { 
    //     header('Location: home.html');
    //     exit();
    // }
    $user_id = $_SESSION["user_id"];
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
    $purchases_query="select * from purchases where user_id='".$user_id."' order by time desc";
    $purchases_result=mysqli_query($conn, $purchases_query);

    //$table="<table class='table table-bordered'><thead><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th></tr></thead><tbody>";

    $totalOrders = array();
    while ($purchases_row = mysqli_fetch_array($purchases_result))
    {
        $movie_id=$purchases_row["movie_id"];
        $movie_query="select * from movie where movie_id=".$movie_id;
        $movie_result=mysqli_query($conn, $movie_query);
        $movie_row = mysqli_fetch_array($movie_result);
        $poster =  preg_replace('/185/','92',$movie_row['imageUrl']);  
        //$table=$table."<tr><td><img src='" .$poster. "' alt='Image not found' title='".$movie_row['title']."' /></td><td>".$purchases_row["quantity"]."</td><td>$".$purchases_row["price"]."</td><td>".$purchases_row["order_id"]."</td><td>".$purchases_row["time"]."</td></tr>";          
        $list = '';
        $img = "<img src='" .$poster. "' alt='Image not found' title='".$movie_row['title']."' />";
        $list->img = $img;
        $list->qty = $purchases_row["quantity"];
        $list->price = $purchases_row["price"];
        $list->orderId = $purchases_row["order_id"];
        $list->time = $purchases_row["time"];

        array_push($totalOrders,$list);
    }
    //$table=$table."</tbody></table>";
    //echo $table;
    echo json_encode($totalOrders);
?>