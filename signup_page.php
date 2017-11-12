<?php
	session_start();
    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "guest") {
        $user=$_SESSION["user_id"];
        // echo "<script>alert('".$user."')</script>";
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
        $query="select * from users where user_id='".$user."'";
	      $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        $name=$row['name'];
        $pass=$row['password'];
        $address=$row['address'];
        $card_info=$row['card_info'];
        $phone=$row['phone'];
	}
?>
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
    <?php 
    if ($user == "")
    {
      echo "<h2>Create New Account</h2>";
    }
    else
    {
      echo "<h2>Edit Account Info</h2>";
    }
    ?>
    
    <br/>
    <form id="signup" method = "POST">
      <p>  
      <label for="userid">User ID </label>
      <input type="text" name="userid" id="userid" placeholder="userid" 
      <?php 
      if ($user != "")
      {
        echo 'value="'.$user.'"  disabled';
      }
      ?> 
      required/>
      <br/><br/>
        
      <label for="name">Name </label>
      <input type="text" name="name" id="name" placeholder="name" <?php echo 'value="'.$name.'"'?> required/>
      <br/><br/>

      <label for="password">Password </label>
      <input type="password" name="password" id="password" placeholder="password" <?php echo 'value="'.$pass.'"'?> required/>
      <br/><br/>

      <label for="address">Address </label>
      <input type="text" name="address" id="address" placeholder="address" <?php echo 'value="'.$address.'"'?> required/>
      <br/><br/>

      <label for="card_info">Card Information </label>
      <input type="text" name="card_info" id="card_info"  maxlength="16" placeholder="card_info" <?php echo 'value="'.$card_info.'"'?> required/>
      <br/><br/>

      <label for="phonenumber">Phone Number </label>
      <input type="text" name="phonenumber" id="phonenumber" maxlength="10" placeholder="phonenumber" <?php echo 'value="'.$phone.'"'?> required/>
      <br/><br/>

      <button type="button" id="submit" name="submit">
      <?php 
      if ($user == "")
      { 
        echo 'Sign up';
      }
      else
      {
        echo 'Save';
      }
      ?>
      </button>
      </p>
         
    </form>
<body>
</html>