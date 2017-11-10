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
            echo $_POST["card_info"];

            $userid = $_POST["userid"];
            $phonenumber = $_POST["phonenumber"];
            $address = $_POST["address"];
            $password = $_POST["password"];
            $card_info = $_POST["card_info"];
            $name = $_POST["name"];
            echo $card_info;
            $sql = "INSERT INTO users VALUES ('$userid', '$name', '$password', '$address', '$card_info', '$phonenumber', '1')";
           //echo $sql;
            mysqli_query($con, $sql);
        }
?>