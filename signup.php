<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "onlinemoviestore";

// function runQuery($query) {
//     $results = "";
//     while($row = mysqli_fetch_array($query)){
//         $results = $results."<tr><td>".$row["name"]."</td><td>".$row["year"]."</td><td>".$row["ranking"]."</td><td>".$row["gender"]."</td></tr>";
//     }
//     return $results;
// }
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
                echo "Error";
              }
          } 

             if(!empty($_POST["phonenumber"])) {
              $phonenumber = $_POST["phonenumber"];
              $sql = "SELECT * FROM users WHERE phone='$phonenumber';";
                $query = mysqli_query($con, $sql);
                if(mysqli_num_rows($query) == 0){
                  echo "Ok";
                }
                else{
                  echo "Error";
                }
        }
      }

?>