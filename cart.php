<?php
    session_start();
    if(isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
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

    $data = "<thead><tr><th>Movie</th><th>Quantity</th><th></th></tr></thead><tbody>";
    while ($row = mysqli_fetch_array($cart_result)){
        //echo $row['quantity']." ".$row['movie_id'];
        $movie = mysqli_query($conn, "select title from movie where movie_id='".$row['movie_id']."';");
        $moviename = mysqli_fetch_array($movie);
        //echo $moviename['title'];        
        $data = $data."<tr><td>".$moviename['title']."</td><td><div class='center'><div class='input-group'><span class='input-group-btn'>";
        $data = $data."<button type='button' class='btn btn-default btn-number' id='btn".$row['movie_id']."' data-type='minus' data-field='quant[1]'><span class='glyphicon glyphicon-minus'></span></button></span>";
        $data = $data."<input type='text' id='inp".$row['movie_id']."' name='quant[1]' class='form-control input-number' value='".$row['quantity']."' min='1' max='10'>";
        $data = $data."<span class='input-group-btn'><button type='button' class='btn btn-default btn-number' id='btn".$row['movie_id']."' data-type='plus' data-field='quant[1]'><span class='glyphicon glyphicon-plus'></span>";
        $data = $data."</button></span></div></div></td><td><button type='button' id='btn".$row['movie_id']."' class='btn btn-danger'>Delete</button></td></tr>";    
    }
    $data = $data."</tbody>";
?>
<!DOCTYPE html>
<html>  
    <head>
        <title></title>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="cart.js"></script>
        <link href="css/cart.css" rel="stylesheet">   
        <script src="js/cart.js"></script>
    </head>
    <body> 
        <nav class='navbar navbar-inverse' style='background-color: rgba(10, 10, 10, 1); margin:0%;'>
            <div class='container-fluid'>
                <ul class='nav navbar-nav'>
                    <li ><a href='home.html'>Home</a></li> 
                    <li><a href='/checkin' style='height: 10px'>Login</a></li>
                    <li><a href='/borrower' style='height: 10px'>Sign Up</a></li>
                    <li class='active'><a href='cart.html' style='height: 10px'>Cart</a></li>
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
        <div class="container">
            <h2>Hello <?php  echo $_SESSION['user_id']?>,</h2>
            <p>Please find your cart details below:</p>            
            <table class="table table-bordered">
                <?php echo $data ?>
            </table>
        </div>
  
  </body>
</html>


