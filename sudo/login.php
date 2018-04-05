<?php
$alert = "";
if (isset($_POST['inputUser'])){
  include_once("functions.php");
  $dbh = connectDB();
  $sql = "SELECT id,user_pass,display_name
        FROM users
        WHERE user_login = :userLogin
        ";
$sth = $dbh->prepare($sql);
$sth->execute( array(":userLogin" => $_POST['inputUser']));
$creds = $sth->fetch(PDO::FETCH_ASSOC);
$cDir = $_SERVER['PHP_SELF'];
print_r($creds);
if (password_verify($_POST['inputPassword'],$creds['user_pass'])){
  session_start();
  $_SESSION['display_name'] = $creds['display_name'];
  $_SESSION['user_id'] = $creds['id'];
  header("Location: pages/index.php");
}
else{
  $alert = "<div class='alert alert-danger' role='alert'>
            <strong>Error!</strong> Wrong Username or Password.
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
          <?= $alert;?>
        <input type="text" name="inputUser" class="form-control" placeholder="Username" required="" autofocus="">
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
    
  </body>
  <? include_once("html/footer.html")?>
  </html>
