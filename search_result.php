<?php
	session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
?>
<!DOCTYPE html>
<html>  
    <head>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", rel="stylesheet">
        <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/searchPage.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <script src="js/recent.js"></script>
        <script src="js/popular.js"></script> 
        <script src="js/add_cart.js"></script>
        <script src="js/search_result.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/login.js"></script>
    </head>
    <body> 
        <?php require('nav_bar.php');?>
        <?php require('loginModal.php');?>
        <br/>
        <div class="searchResults col-lg-12 col-md-10">
            <h1>Search Results</h1> 
            <div id="searchResults" class="searchResults cover-container">
            </div>
            <div class="orderbutton">
                <button id= 'prBtn' type = 'button' class='btn btn-primary' value='0'>Previous</button>
                <button id= 'nxtBtn' type = 'button' class='btn btn-primary' value='0'>Next</button>
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


