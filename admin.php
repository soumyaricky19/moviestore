<?php
    session_start();
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
    $movieId = $_GET['movie_id'];
    
    $query="select * from movie where movie_id='".$movieId."'";
    $result=mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>  
    <head>
        <title></title>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/admin.css" rel="stylesheet">   
        <script src="js/cart.js"></script>
        <script src="js/add_update_movie.js"></script>
    </head>
    <body> 
        <nav class='navbar navbar-inverse' style='background-color: rgba(10, 10, 10, 1); margin:0%;'>
            <div class='container-fluid'>
                <ul class='nav navbar-nav'>
                    <li><a href='home.php'>Home</a></li> 
                    <li><a href="">Login</a></li>
                    <li><a href='signup_page.php'>Sign Up</a></li>
                    <li class='active'><a href='cart.php'>Cart (<?php require ('num_cart.php');?> )</a></li>
                    <li><a href='order_history.php'>Orders</a></li>
                </ul>
                <form method = 'GET' action = 'search_result.php' class='navbar-form navbar-right'>
                <div class='form-group'>
                    <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40'/>&nbsp; &nbsp;
                    <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
                </div>
                </form>
            </div>         
        </nav>
        <div class="container detail">
            <h2>Hello <?php  echo $_SESSION['user_id']?>,</h2>
            <p>Please add the movie details below:</p>            
            <form id="movieDetails" method="POST">
                <table id="movieInfo" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Movie Title</td>
                            <td><input type="text" class="form-control" id="title" placeholder="Enter movie name" value="<?php  echo $row['title']?>" required></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><textarea class="form-control" rows="5" id="descr" placeholder="Enter movie description" required><?php  echo $row['description']?></textarea></td>
                        </tr>
                        <tr>
                            <td>Director</td>
                            <td><input type="text" class="form-control" id="director" placeholder="Enter director name" value='<?php  echo $row['director']?>' required></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td><input type="number"  class="form-control" id="year" maxlength="4" placeholder="Enter year" value='<?php  echo $row['year']?>' required></td>
                        </tr>
                        <tr>
                            <td>Image Link</td>
                            <td><input type="text" class="form-control" id="img" placeholder="Enter image link" value='<?php  echo $row['imageUrl']?>' required></td>
                        </tr>
                        <tr>
                            <td>Duration (Minutes)</td>
                            <td><input type="number" class="form-control" id="duration" placeholder="Enter movie duration" value='<?php  echo $row['duration']?>' required></td>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td><input type="number" class="form-control" id="rating" min="1" max="10" placeholder="Enter movie rating" value='<?php  echo $row['rating']?>' required></td>
                        </tr>
                        <tr>
                            <td>Votes</td>
                            <td><input type="number" class="form-control" id="votes" placeholder="Enter votes" value='<?php  echo $row['votes']?>' required></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><input type="number" class="form-control" id="qty" placeholder="Enter available quantity" value='<?php  echo $row['quantity']?>' required></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="number" class="form-control" id="price" placeholder="Enter movie price" value='<?php  echo $row['price']?>' required></td>
                        </tr>
                    </tbody>
                </table>
                <div class="save">
                    <button id="saveBtn" type = 'submit' class='btn btn-primary'>Save</button>
                </div>
            </form>
        </div>
  </body>
</html>


