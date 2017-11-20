<?php
	session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    session_start();
    $user_id=$_SESSION["user_id"];
?>
<nav class='navbar navbar-inverse navbar-fixed-top'>
    <div class='container-fluid'>
        <ul id='nav' class='nav navbar-nav'>
            <li id='home'><a href='home.php'>Home</a></li> 
            <?php  
                if ($user_id != "" && $user_id != "guest" && $user_id != "admin") {
                    echo ("<li id='orders'><a href='order_history.php'>Orders</a></li>");
                }
            ?>
            <li>
                <form method = 'GET' class='navbar-form navbar-right' action='search_result.php'>
                    <div class='form-group'>
                        <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40' required/>&nbsp; &nbsp;
                        <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
                    </div>
                </form>
            </li>
            <?php  
                if ($user_id == "admin") {
                    echo ("<li><div id='addMovie' class='adminButton'><button id='addBtn' type ='button' class='btn btn-primary'>Add Movie</button></div></li>");
                }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php 
                echo ("<li><a href='signup_page.php'> Welcome " .$user_id."</a></li>");
                if ($user_id != "" && $user_id != "guest") {
                    echo ("<li id='login'><a href='logout.php'>Logout</a></li>");
                }
                else {                        
                    //echo ("<li id='login'><a href='login_page.php'>Login</a></li><li id='signup'><a href='signup_page.php'>Sign Up</a></li>"); 
                    echo ("<li id='login'><a href='#' data-toggle='modal' data-target='#login-modal'><span class='glyphicon glyphicon-log-in'></span>&nbsp;Login</a></li><li id='signup'><a href='signup_page.php'><span class='glyphicon glyphicon-user'></span>&nbsp;Sign Up</a></li>");       
                }
            ?>
            <!-- <li id='cart'><a href='cart.php'>Cart (<?php require('num_cart.php');?> ) </a></li> -->
            <li id='cart'>
                <a href="cart.php" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-shopping-cart"></span> <?php require('num_cart.php');?>
                </a>
            </li>
            
        </ul>
        <script>  
            $(document).ready(function(){
                var url=window.location.href;
                var arr = url.split('/');
                // alert(arr);
                var page_name=arr[arr.length - 1];
                switch(page_name) {
                    case "login.php":
                        '#login'.addClass('active');
                        break;
                    case "signup_page.php":
                        $('#signup').addClass('active');
                        break;
                    case "cart.php":
                        $('#cart').addClass('active');
                        break;
                    case "order_history.php":
                        $('#orders').addClass('active');
                        break;
                    default:
                        $('#home').addClass('active');
                }
            });
        </script>
    </div>
</nav>         
