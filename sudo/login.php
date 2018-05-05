<?php
if($_SERVER['HTTP_HOST']=='localhost'){
  $includePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'tomSite'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR;
}
else{
  $includePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR;
}
set_include_path($includePath);
$alert = "";
if (isset($_POST['inputUser'])){
  include_once("functions.php");
  $dbh = connectDB();
  $columns = array(
    'id',
    'user_pass',
    'display_name'
  );
    $conditions = array(
    'user_login'=>$_POST['inputUser']
  );
  $data = ezSelect('users',$columns,$conditions);
  if($data['success']){
    $creds = $data['entries'][0];
    $cDir = $_SERVER['PHP_SELF'];
    if (password_verify($_POST['inputPassword'],$creds['user_pass'])){
      session_start();
      $_SESSION['display_name'] = $creds['display_name'];
      $_SESSION['user_id'] = $creds['id'];
      header("Location: pages/index.php");
    }
    else{
      $message = 'Username or Password is wrong.';
      $alert = "<div class='alert alert-danger' role='alert'>
      <strong>Error!</strong> $message
      </div>";
    }
  }
  else{
    $message = $data['error'];
    $alert = "<div class='alert alert-danger' role='alert'>
    <strong>Error!</strong> $message
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
        <input type="text" name="inputUser" class="form-control" placeholder="Username" required="" autofocus="">
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </body>
  <? include_once("html/footer.html")?>
  </html>
