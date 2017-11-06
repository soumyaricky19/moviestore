<!DOCTYPE html>
<html>  
    <head>
        <title></title>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/recent.js"></script>
        <script src="js/popular.js"></script> 
        <script src="js/add_cart.js"></script>
    </head>
    <body> 
        <nav class='navbar navbar-inverse' style='background-color: rgba(10, 10, 10, 1); margin:0%;'>
            <div class='container-fluid'>
                <ul class='nav navbar-nav'>
                    <li><a href='home.php'>Home</a></li> 
                    <li><a href="">Login</a></li>
                    <li><a href='signup_page.php'>Sign Up</a></li>
                    <li><a href='cart.php'>Cart (<?php require('num_cart.php');?> ) </a></li>
                    <li class='active'><a href='order_history.php'>Orders</a></li>   
                </ul>
                <form method = 'GET' action = 'search_result.php' class='navbar-form navbar-right'>
                <div class='form-group'>
                    <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40'/>&nbsp; &nbsp;
                    <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
                </div>
                </form>
            </div>         
        </nav>
        <br/>
        <div class="order col-lg-12 col-md-10">
            <h1>Order history</h1> 
            <div class="orderContainer">    
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
                    
                    //$table="<table><tr><th>Title</th><th>Quantity</th><th>Price</th><th>Order_id</th><th>Date/Time</th></tr>";
                    $table = "<table class='table table-bordered'><thead><tr><th>Movie</th><th>Quantity</th><th>Price</th><th>OrderId</th><th>Date/Time</th></tr></thead><tbody>";

                    while ($purchases_row = mysqli_fetch_array($purchases_result))
                    {
                        $movie_id=$purchases_row["movie_id"];
                        $movie_query="select * from movie where movie_id=".$movie_id;
                        $movie_result=mysqli_query($conn, $movie_query);
                        $movie_row = mysqli_fetch_array($movie_result);
                        $poster =  preg_replace('/185/','92',$movie_row['imageUrl']);  
                        $table=$table."<tr><td><img src='" .$poster. "' alt='Image not found' title='".$movie_row['title']."' /></td><td>".$purchases_row["quantity"]."</td><td>$".$purchases_row["price"]."</td><td>".$purchases_row["order_id"]."</td><td>".$purchases_row["time"]."</td></tr>";
                    }
                    $table=$table."</tbody></table>";
                    echo $table;
                    //echo "<script> alert('".$table."')</script>";
                ?>
            </div>
        </div>

        <div class="recent col-lg-12 col-md-10">
            <h1>Recent</h1> 
            <div id="recent" class="recent cover-container">            
            </div>
        </div>
        
        <div class="popular col-lg-12 col-md-10">
            <h1>Popular</h1> 
            <div id="popular" class="popular cover-container">   
            </div>
        </div>
    </body>
</html>


