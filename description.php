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
                    <li class='active'><a href='home.html'>Home</a></li> 
                    <li><a href='/checkin' style='height: 10px'>Login</a></li>
                    <li><a href='/borrower' style='height: 10px'>Sign Up</a></li>
                    <li><a href='/fines' style='height: 10px'>Cart</a></li>
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
        <div class='description-container'>
            <div class='description-item'>
                <?php
                    session_start();
                    if(isset($_SESSION["user_id"])) {
                        $user_id = $_SESSION["user_id"];
                    }
                    
                    $movie_id = $_GET["id"];
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
                    
                    $query="select * from movie where movie_id=".$movie_id;
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_array($result);
                    
                    $list=$list."<li>".$row["title"]."</li>"; 
                    $cast=array();
                    $query1="select actor_name from actors where actor_id in (select actor_id from movie_actor where movie_id=".$movie_id.")";
                    $result1 = mysqli_query($conn,$query1);
                    
                    while ($row1 = mysqli_fetch_array($result1)){
                        array_push($cast, $row1['actor_name']);
                    }
                    $casts=join(",",$cast);
                    $quantity=$row["quantity"];
                    $info='<table><tr><td>Title: '.$row["title"].'</td></tr><tr><td>Description: '.$row["description"].'</td></tr><tr><td>Director: '.$row["director"].'</td></tr><tr><td>Year: '.$row["year"].'</td></tr><tr><td>Duration: '.$row["duration"].' mins</td></tr><tr><td> Rating: '.$row["rating"].'</td></tr><tr><td> Votes:'.$row["votes"].'</td></tr><tr><td>Available quantity: '.$quantity.'</td></tr><tr><td>Price:'.$row["price"].'</td></tr><tr><td>Cast: '.$casts.'</td></tr></table>';

                    //echo $info;
                    //echo '<input type = "hidden" id="m" value='.$movie_id.'>';
                    //echo '<input type = "hidden" id="u" value='.$user_id.'>';
                    //echo "<br/><button id='btn' type = 'submit' class='btn btn-primary' style = 'width: 150px'>Add to cart</button></div>";   
                
                    $poster =  preg_replace('/185/','500',$row['imageUrl']);  
                    $img = "<img src='" .$poster. "' alt='Image not found' title='".$row['title']."' />";
                    $img = $img."<div class='movieDetails'>Movie: <p>".$row['title']."</p>Description: <p>".$row['description']."</p>Director: <p>".$row['director']."</p>Cast: <p>".$casts."</p>Year: <p>".$row['year']."</p>Duration: <p>".$row['duration']." minutes</p>Rating: <p>".$row['rating']."</p>Votes: <p>".$row['votes']."</p>Available Quantity: <p>".$quantity."</p>Price: <p>".$row['price']."</p></div>";
                    
                    $img = $img."<div class='descDetailContainer'><span>Qty: <input type='number' id='qty".$row['movie_id']."' min='1' max='".$quantity."' required></span>";
                    $img = $img."&nbsp;<button type='button' id='btn".$row['movie_id']."'>Add to Cart</button></div>";
                    
                    
                    
                    echo $img;
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


