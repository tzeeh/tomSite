<?php 
set_include_path('/opt/lampp/htdocs/tom/tomsSite/includes/');
include_once("functions.php");
$columns = array(
  "ID",
  "post_content",
  "post_name",
  "tags",
  "post_title"
  
);
$conditions = array(
  "ID"=>$_GET['id']
);
$results = ezSelect('posts', $columns,$conditions);
echo json_encode($results);
 
 
 ?>



