<?php
session_start();
set_include_path($_SESSION['includePath']);
include_once("php/functions.php");
echo encrypt('Swm@mf2969');
$alert = "";
  $sql = 
  "SELECT id, password, display_name
  FROM users
  WHERE username = ?";
  $param = array(
    $_POST['inputUser']
  );
  $request = ezCustom($sql, $param);
  $data = $request['data'];
  var_dump($data);
  if(password_verify($_POST['inputPassword'],$data['password'])){
    echo 'success';
  }
  else{
    echo 'fail';
  }
  // if($request['success']){
  //   $creds = $request['data'];
  //   $cDir = $_SERVER['PHP_SELF'];
  //   if (password_verify($_POST['inputPassword'],$creds['password'])){
  //     $_SESSION['display_name'] = $creds['display_name'];
  //     $_SESSION['user_id'] = $creds['id'];
  //     echo 'success';
  //   }
  //   else{
  //     $message = 'Username or Password is wrong.';
  //     $alert = "<div class='alert alert-danger' role='alert'>
  //     <strong>Error!</strong> $message
  //     </div>";
  //   }
  // }
  // else{
  //   $message = $request['error'];
  //   $alert = "<div class='alert alert-danger' role='alert'>
  //   <strong>Error!</strong> $message
  //   </div>";
  // }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <title>Tom Zeeh</title>
  </head>
  
  <body> 
    <div class="container"> 
      <form class="form-signin" method="post"action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
          <h2 class="form-signin-heading">Please sign in</h2>
          <?php echo $alert;?>
        <input type="text" name="inputUser" class="form-control" placeholder="Username" required="" autofocus="">
        <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
  </body>
  <?php include_once('php/partials/footer.php')?>
  </html>
