<?php
session_start();
if(!isset($_SESSION['display_name'])){
    header("Location: ../login.php");
}
$alert = "";
var_dump($_POST);
if (isset($_POST['inputTitle'])){
  include_once("../functions.php");
  $dbh = connectDB();
  $sql = "";
$sth = $dbh->prepare($sql);
$sth->execute( array(
  ":email" => $_POST['inputEmail']
));
$creds = $sth->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Tom Zeeh</title>
</head>

<body>
    <? include_once("../navigation-sudo.php")?>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
      <form action="" method="post">
      <select name="inputPost"class="form-control">
        <option value="insert">Insert new post or select here</option>
      </select>
      <hr>
        <input class="form-control"type="text" name="inputTitle"placeholder="Title">
        <select name="inputCategory"class="form-control">
          <option value="">Select Category</option>
        </select>
        <textarea name="inputContent" class="form-control" cols="30" rows="10"placeholder="Insert HTML Here"></textarea>
        <input class="form-control"type="text" name="inputTitle"placeholder="Tags (Separate by ',')">
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </form>
    </div>
            
</body>
<? include_once("../../html/footer.html")?>

</html>