<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
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

    $cart_query="select * from cart where user_id='".$user_id."'";
    $cart_result=mysqli_query($conn, $cart_query);
    $number_of_rows = mysqli_num_rows($cart_result);
    $totalQuantity = 0;
    $totalPrice = 0;

    if($number_of_rows == 0){
        $data = "<div id='emptyCart'>Your cart is empty.</div>";
    } 
    else {
        $data = "<thead><tr><th>Movie</th><th>Quantity</th><th>Price</th><th></th></tr></thead><tbody>";
        while ($row = mysqli_fetch_array($cart_result)){
            //echo $row['quantity']." ".$row['movie_id'];
            $totalQuantity = $totalQuantity + $row['quantity'];
            $totalPrice = $totalPrice + $row['price'];    
            $movie = mysqli_query($conn, "select * from movie where movie_id='".$row['movie_id']."';");
            $moviename = mysqli_fetch_array($movie);
            $data = $data."<tr><td>".$moviename['title']."</td><td><div class='center'><div class='input-group'><span class='input-group-btn'>";
            $data = $data."<button type='button' class='btn btn-default btn-number' id='btn".$row['movie_id']."' data-type='minus' data-field='quant[1]'><span class='glyphicon glyphicon-minus'></span></button></span>";
            $data = $data."<input type='text' id='inp".$row['movie_id']."' name='quant[1]' class='form-control input-number' value='".$row['quantity']."' min='1' max='".$moviename['quantity']."'>";
            $data = $data."<span class='input-group-btn'><button type='button' class='btn btn-default btn-number' id='btn".$row['movie_id']."' data-type='plus' data-field='quant[1]'><span class='glyphicon glyphicon-plus'></span>";
            $data = $data."</button></span></div></div></td><td><p class='price' id='p".$row['movie_id']."'>$".$row['price']."</p></td><td><button type='button' id='btn".$row['movie_id']."' class='btn btn-danger'>Delete</button></td></tr>";    
        }
        $data = $data."<tr><td><div class='total'>Total</div></td><td><div id='totalQty' class='total'>".$totalQuantity."</div></td><td><div id='totalPrice' class='total'>$".$totalPrice."</div></td><td><button type='button' class='btn btn-success'>Buy</button></td></tr>";
        $data = $data."</tbody>";
    }
?>
<!DOCTYPE html>
<html>  
    <head>
        <title></title>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/cart.css" rel="stylesheet">   
        <script src="js/cart.js"></script>
    </head>
    <body> 
        <?php require('nav_bar.php');?>
        <div class="container cart">
            <h2>Hello <?php  echo $_SESSION['user_id']?>,</h2>
            <p>Please find your cart details below:</p>            
            <table id="cartTable" class="table table-bordered">
                <?php echo $data ?>
            </table>
        </div>
  </body>
</html>


