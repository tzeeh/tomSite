<?php
session_start();
set_include_path('/opt/lampp/htdocs/tom/tomsSite/includes/');

if(!isset($_SESSION['display_name'])){
    header("Location: ../login.php");
}
$alert = "";
if (isset($_POST['inputTitle'])){
  include_once("functions.php");
  if(isset($_POST['btnDraft'])){
    $status = "draft";
    $date = null;
  }
  else{
    $status = "publish";
    $date = date("Y-m-d H:i:s");
  }
  $columns = array(
    "post_title"=> $_POST['inputTitle'],
    "post_content"=>$_POST['inputContent'],
    "post_author"=>$_SESSION['user_id'],
    "post_status"=>$status,
    "tags"=>$_POST['inputTags'],
    "post_date"=>date("Y-m-d H:i:s"),
    "guid"=> $_POST['inputGuid']
  );
  $result = easyData('insert','posts',$columns);
  if($result['success']){
    $alert = "<div class='alert alert-success' role='alert'>
    <strong>YAY!</strong> Data Submitted!
    </div>";
  }
  else{
    $error = $result[2];
    var_dump($error);
    $alert = "<div class='alert alert-danger' role='alert'>
    <strong>Error!</strong> $error
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
    <link rel="stylesheet" href="../../includes/css/style.css">
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Tom Zeeh</title>
</head>

<body>
    <? include_once("navigation-sudo.php")?>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
      <form action="" method="post">
      <? echo $alert;?>
      <select name="inputPost"class="form-control">
        <option value="insert">Insert new post or select here</option>
      </select>
      <hr>
        <input class="form-control"type="text" name="inputTitle"placeholder="Title"required>
        <input class="form-control"type="text" name="inputGuid"placeholder="Short address name"required>
        <textarea name="inputContent" class="form-control" cols="30" rows="10"placeholder="Insert HTML Here"required></textarea>
        <input class="form-control"type="text" name="inputTags"placeholder="Tags (Separate by ',')">
        <button type="submit" name="btnDraft"class="btn btn-primary btn-block">Save as Draft</button>
        <button type="submit" name="btnPublish"class="btn btn-primary btn-block">Publish</button>
      </form>
    </div>
            
</body>
<? include_once("html/footer.html")?>

</html>