    <nav class='navbar navbar-inverse'>
          <div class='container-fluid'>
            <ul id="nav" class='nav navbar-nav'>
                <li id="home"><a href='home.php'>Home</a></li> 
                <li id="login"><a href="">Login</a></li>
                <li id="signup"><a href='signup_page.php'>Sign Up</a></li>
                <li id="cart"><a href='cart.php'>Cart (<?php require('num_cart.php');?> ) </a></li>
                <li id="orders"><a href='order_history.php'>Orders</a></li>
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
            <form method = 'GET' class='navbar-form navbar-right' action='search_result.php'>
              <div class='form-group'>
                <input type = 'text' class='form-control' name = 'search' placeholder = 'Search Movie' size='40' required/>&nbsp; &nbsp;
                <button type = 'submit' class='btn btn-primary' style = 'width: 150px'>Search</button>
              </div>
            </form>
          </div>         
      </nav>