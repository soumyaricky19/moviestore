<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <title>Signup</title>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css", rel="stylesheet">
  <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js'></script>
  <script src="js/login.js"></script>
</head>

<body>
  <?php require('nav_bar.php');?>
    <p>
    <h2>Please login</h2>
    <br/>
      <p>  
      <label for="userid">User ID </label>
      <input type="text" name="userid" id="userid" placeholder="userid" required/>
      <br/><br/>
      
      <label for="password">Password </label>
      <input type="password" name="password" id="password" placeholder="password" required/>
      <br/><br/>

      <button type="button" id="submit" name="submit">Login</button>
      </p>
<body>
</html>