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
    <meta charset="utf-8">
    <title>Signup</title>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", rel="stylesheet">
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet" >
    <link href="css/login.css" rel="stylesheet">
    <script src="js/signup.js"></script>
    <script src="js/login.js"></script>
  </head>
  <body>
    <?php require('nav_bar.php');?>
    <?php require('loginModal.php');?>

    <div class="container detail">
      <h2><?php if ($user == ""){echo "Create New Account";} else{ echo "Edit Account Info";}?></h2>
      <p>Please add your details below:</p>            
      <form id="signupDetails" method="POST" onsubmit="return false">
          <table id="signupInfo" class="table table-bordered">
              <tbody>
                  <tr>
                      <td>User ID</td>
                      <td><input class="form-control" type="text" name="userid" id="userid" placeholder="Enter userid" <?php if ($user != "") { echo 'value="'.$user.'"  disabled';} ?> required/></td>
                  </tr>
                  <tr>
                      <td>Name</td>
                      <td><input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value='<?php  echo $name ?>' required></td>
                  </tr>
                  <tr>
                    <td>Password</td>
                    <td>
                        <input type="password"  class="form-control" name="password" id="password" placeholder="Enter password" value='' required>
                        <meter max="4" id="password-strength-meter"></meter>
                        <p id="password-strength-text"></p>
                    </td>
                  </tr>
                  <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password"  class="form-control" name="cnfPassword" id="cnfPassword" placeholder="Confirm password" value='' required>
                    </td>
                  </tr>
                  <tr>
                      <td>Address</td>
                      <td><textarea class="form-control" rows="5" name="address" id="address" placeholder="Enter address details" required><?php  echo $address?></textarea></td>
                  </tr>
                  <tr>
                      <td>Card Information</td>
                      <td><input type="text" class="form-control" name="card_info" id="card_info"  maxlength="16" placeholder="Enter card number" value='<?php  echo $card_info?>' required></td>
                  </tr>
                  <tr>
                      <td>Phone Number</td>
                      <td><input type="text" class="form-control" name="phonenumber" id="phonenumber" maxlength="10" placeholder="Enter phone number" value='<?php  echo $phone?>' required></td>
                  </tr>
              </tbody>
          </table>
          <div class="save">
              <input id='btnSave' name='btnSave' type = 'submit' class='btn btn-primary' value='<?php if ($user == ""){ echo "Sign up";} else{echo "Save";}?>'></button>
          </div>
      </form>
    </div>
  <body>
</html>