<?php
    session_start();
    unset($_SESSION["user_id"]);
    unset($_SESSION["session_cart"]);
    header("location: home.php");
    exit();
?>