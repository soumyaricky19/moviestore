<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css", rel="stylesheet">
  <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
  <script src="js/login.js"></script>
  <link href="css/login.css" rel="stylesheet">
</head>

<body>
  <?php require('nav_bar.php');?>
    <h2>Please login</h2>
    <br/> 
    <label for="userid">User ID </label>
    <input type="text" name="userid" id="userid" placeholder="userid" required/>
    <br/><br/>
    
    <label for="password">Password </label>
    <input type="password" name="password" id="password" placeholder="password" required/>
    <br/><br/>

    <button type="button" id="submit" name="submit">Login</button>

<body>
</html>
