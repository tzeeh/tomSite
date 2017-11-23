<?php
$alert = "";
if (isset($_POST['inputEmail'])){
  include_once("functions.php");
  $dbh = connectDB();
  $sql = "SELECT pass,display_name
        FROM users
        WHERE email = :email
        ";
$sth = $dbh->prepare($sql);
$sth->execute( array(":email" => $_POST['inputEmail']));
$creds = $sth->fetch(PDO::FETCH_ASSOC);
$cDir = $_SERVER['PHP_SELF'];
if (password_verify($_POST['inputPassword'],$creds['pass'])){
  session_start();
  $_SESSION['display_name'] = $creds['display_name'];
  header("Location: pages/index.php");
}
else{
  $alert = "<div class='alert alert-danger' role='alert'>
            <strong>Error!</strong> Wrong Email or Password.
            </div>";
}

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Tom Zeeh</title>
  </head>
  
  <body>    
    <div class="container"> 
      <form class="form-signin" method="post"action="<?echo($_SERVER['PHP_SELF']) ?>">
          <h2 class="form-signin-heading">Please sign in</h2>
          <? echo $alert;?>
        <input type="text" name="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
    
  </body>
  <? include_once("../html/footer.html")?>
  </html>
