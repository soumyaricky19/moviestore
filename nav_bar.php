<?php
	session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    session_start();
    $user_id=$_SESSION["user_id"];
?>
    <nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <ul id='nav' class='nav navbar-nav'>
                <li id='home'><a href='home.php'>Home</a></li> 
                <?php  
                    if ($user_id != "" && $user_id != "guest" && $user_id != "admin") {
                        echo ("<li id='orders'><a href='order_history.php'>Orders</a></li>");
                    }
                ?>
                <li><form method = 'GET' class='navbar-form navbar-right' action='search_result.php'>
                    <div class='form-group'>
                        <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40' required/>&nbsp; &nbsp;
                        <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
                    </div>
                </form></li>
                <?php 
                    // echo ("<script>alert('".$user_id."')</script>");
                    if ($user_id != "" && $user_id != "guest") {
                        echo ("<li id='login'><a href='logout.php'>Logout</a></li>");
                    }
                    else {                        
                        //echo ("<li id='login'><a href='login_page.php'>Login</a></li><li id='signup'><a href='signup_page.php'>Sign Up</a></li>");
                        
                        echo ("<li id='login'><a href='#' data-toggle='modal' data-target='#login-modal'>Login</a></li><li id='signup'><a href='signup_page.php'>Sign Up</a></li>");
                        
                    }
                    echo ("<li><h3><a href='signup_page.php'> Welcome " .$user_id."</a></h3></li>");
                ?>
                <li id='cart'><a href='cart.php'>Cart (<?php require('num_cart.php');?> ) </a></li>
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
                
                // $('#nav li').click(function() {
                //     // $(this).siblings('li').removeClass('active');
                //     $(this).addClass('active');
                // });
            });
            </script>
          </div>         
      </nav>