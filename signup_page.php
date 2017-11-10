<!DOCTYPE html>
<html> 
<head>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
	<script src="js/signup.js"></script>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/signup.css">
  <title>Signup</title>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
  <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
  <link href="css/style.css" rel="stylesheet">
  <script src="js/recent.js"></script>
  <script src="js/popular.js"></script> 
  <script src="js/add_cart.js"></script>
  <script src="js/genre.js"></script> 
  <script src="js/carousel.js"></script>
</head>

<body>
  <?php require('nav_bar.php');?>
    
  <div id="modal-wrapper" class="modal">
    
    <form class="modal-content animate" action="login.php">
          
      <div class="imgcontainer">
        <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
        <h1 style="text-align:center">Modal Popup Box</h1>
      </div>

      <div class="container">
        <input type="text" placeholder="Enter Username" name="uname">
        <input type="password" placeholder="Enter Password" name="psw">        
        <button type="submit">Login</button>
      </div>
      
    </form>
  </div>
    <p>
    <h2>Create New Account</h2>
    <br/>
    <form id="signup" method = "POST">
      <p>  
      <label for="userid">User ID </label>
      <input type="text" name="userid" id="userid" placeholder="userid" required/>
      <br/><br/>
        
      <label for="name">Name </label>
      <input type="text" name="name" id="name" placeholder="name" required/>
      <br/><br/>

      <label for="password">Password </label>
      <input type="password" name="password" id="password" placeholder="password" required/>
      <br/><br/>

      <label for="address">Address </label>
      <input type="text" name="address" id="address" placeholder="address" required/>
      <br/><br/>

      <label for="card_info">Card Information </label>
      <input type="text" name="card_info" id="card_info"  maxlength="16" placeholder="card_info" required/>
      <br/><br/>

      <label for="phonenumber">Phone Number </label>
      <input type="text" name="phonenumber" id="phonenumber" maxlength="10" placeholder="phonenumber" required/>
      <br/><br/>

      <button type="button" id="submit" name="submit">Sign up</button>
      </p>
         
    </form>
<body>
</html>