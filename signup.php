<?php
  session_start();
  if(!isset($_SESSION["user_id"])) {
          header("location: home.php");
          exit();
  }
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $db = "onlinemoviestore";

  $con=mysqli_connect($servername,$username,$password,$db);
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["userid"])) {
      $userid = $_POST["userid"];
      $sql = "SELECT * FROM users WHERE user_id='$userid';";
      $query = mysqli_query($con, $sql);
      if(mysqli_num_rows($query) == 0){
        echo "Ok";
      }
      else{
        echo "User name already exists";
      }
    } 

  if(!empty($_POST["phonenumber"])) {
    $phonenumber = $_POST["phonenumber"];
    $sql = "SELECT * FROM users WHERE phone='$phonenumber';";
    
    if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "guest") {
      $sql = "SELECT * FROM users WHERE user_id !='".$_SESSION['user_id']."' and phone='$phonenumber';";
    }
    
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) == 0 ){
      echo "Ok";
    }
    else{
      echo "Phone number already registered";
    }
  }
}

?>