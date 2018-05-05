<?php
session_start();
include_once("functions.php");

if(!isset($_POST['inputTitle'])){
  $_POST['inputTitle']='';
  $_POST['inputContent']='';
  $_POST['inputTags']='';
  $_POST['inputName']='';
  $_POST['id']='';
  $_POST['inputPost']='';
  
}

if(!isset($_SESSION['display_name'])){
    header("Location: ../login.php");
}
$alert = "";
if($_POST['inputPost']!='insert'){
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
    "post_name"=> $_POST['inputName']
  );
  $conditions = array(
    "ID"=>$_POST['id']
  );
  $result = ezUpdate('posts',$columns,$conditions);
  $alert = alert($result);
}
else{

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
    "post_name"=> $_POST['inputName']
  );
  $result = ezInsert('posts',$columns);
  $alert = alert($result);
  
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
    <script src="../../includes/js/updatePost.js"></script>
    <title>Tom Zeeh</title>
</head>

<body>
    <?php include_once("navigation-sudo.php")?>
    <br>
    <br>
    <br>
    <br>
    <div class="container"> 
      <form action="" method="post">
      <?php echo $alert;?>
      <select onchange="selectChange()"id="inputPost"name="inputPost"class="form-control">
        <option value="insert">Insert new post or select here</option>
        <?include("get_posts_select.php")?>
      </select>
      <hr>
        <input class="form-control"type="text" id="id"name="id"placeholder="ID"readonly>
        <input class="form-control"type="text" id="inputTitle"name="inputTitle"placeholder="Title"required>
        <input class="form-control"type="text" id="inputName"name="inputName"placeholder="Short address name"required>
        <textarea id="inputContent"name="inputContent" class="form-control" cols="30" rows="10"placeholder="Insert HTML Here"required></textarea>
        <input class="form-control"type="text" id="inputTags"name="inputTags"placeholder="Tags (Separate by ',')"required>
        <button type="submit" name="btnDraft"class="btn btn-primary btn-block">Save as Draft</button>
        <button type="submit" name="btnPublish"class="btn btn-primary btn-block">Publish</button>
      </form>
    </div>
            
</body>
<?php include_once("html/footer.html")?>

</html>