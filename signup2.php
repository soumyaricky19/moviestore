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
        $userid = $_POST["userid"];
        $phonenumber = $_POST["phonenumber"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $card_info = $_POST["card_info"];
        $name = $_POST["name"];
        $sql="";

        // Password hashing
        $hash = password_hash($password, PASSWORD_DEFAULT);


        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "guest") {
            $sql = "update users set name='".$name."', password='".$hash."', address='".$address."',card_info='".$card_info."',phone='".$phonenumber."' where user_id='".$userid."'";
            echo "Saved successfully";
        }
        else
        {
            $sql = "INSERT INTO users VALUES ('$userid', '$name', '$hash', '$address', '$card_info', '$phonenumber', '1')";
            echo "Account created successfully";
        }
        //echo $sql;
        mysqli_query($con, $sql);
    }
?>