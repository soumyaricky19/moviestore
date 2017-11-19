<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        $_SESSION["user_id"]="guest";
        unset($_SESSION["session_cart"]);
        unset ($_SESSION["movie_id"]);
        unset ($_SESSION["quantity"]);
	  }
?>
<!DOCTYPE html>
<html>  
  <head>
    <title></title>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", rel="stylesheet">
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="js/recent.js"></script>
    <script src="js/popular.js"></script> 
    <script src="js/add_cart.js"></script>
    <script src="js/genre.js"></script> 
    <script src="js/carousel.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/login.js"></script>
      
  </head>
  <body>  
      <?php require('nav_bar.php');?>
      <?php require('loginModal.php');?>
      <div id='carousel'>
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


