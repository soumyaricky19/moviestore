<?php
    session_start();
    $_SESSION["user_id"] = "soumyaricky19";
?>
<!DOCTYPE html>
<html>  
  <head>
    <title></title>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
    <link href="css/style.css" rel="stylesheet">
    <script src="js/recent.js"></script>
    <script src="js/popular.js"></script> 
    <script src="js/add_cart.js"></script>
    <script src="js/genre.js"></script> 
    <script src="js/carousel.js"></script>
    <script src="js/admin.js"></script>
      
  </head>
  <body>  
      <nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <ul class='nav navbar-nav'>
                <li class='active'><a href='home.php'>Home</a></li> 
                <li><a href="">Login</a></li>
                <li><a href='signup_page.php'>Sign Up</a></li>
                <li><a href='cart.php'>Cart (<?php require('num_cart.php');?> ) </a></li>
                <li><a href='order_history.php'>Orders</a></li>
            </ul>
            <form method = 'GET' class='navbar-form navbar-right' action='search_result.php'>
              <div class='form-group'>
                <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40' required/>&nbsp; &nbsp;
                <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
              </div>
            </form>
          </div>         
      </nav>

      <div id='addMovie' class='adminButton'>
        <button id='addBtn' type ='button' class='btn btn-primary'>Add Movie</button>
      </div>

      <div>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Wrapper for slides -->
          <div class="carousel-inner">             
          </div>
        
          <!-- Controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div> <!-- Carousel -->           
      </div>

      <div class="genre col-lg-12 col-md-10">
          <h1>Genre</h1> 
          <div id="genre" class="genre cover-container">            
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


