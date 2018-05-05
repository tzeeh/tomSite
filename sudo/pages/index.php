<?php
session_start();
if(!isset($_SESSION['display_name'])){
    header("Location: ../login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../includes/css/style.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Tom Zeeh</title>
</head>

<body>
    <?php include_once("navigation-sudo.php"); ?>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
      <?php include_once("test.php"); ?>
  </div>
            
</body>
<?php include_once("html/footer.html"); ?>

</html>