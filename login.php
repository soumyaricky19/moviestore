<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("location: home.php");
        exit();
	}
    $user_id = $_SESSION["user_id"];
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

    $userid=$_POST["userid"];
    $password=$_POST["password"];

    $query="select * from users where user_id='".$userid."'";
    $result=mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if ($password == $row["password"])
    {   
        $_SESSION["user_id"]=$userid;
        echo ("Login successful");
    }
    else
    {
        echo ("Incorrect username/password");
    }
?>