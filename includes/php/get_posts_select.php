<?php 
include_once("functions.php");
$id = '';
$title = '';
$columns = array(
  "id",
  "post_title"
  
);
$orderBy = array(
  "post_date"=>"desc"
);
$results = ezSelect('posts', $columns,null,null,null,$orderBy);
foreach ($results['entries'] as $result){
  $id = $result['id'];
  $title = $result['post_title'];
  echo "<option value=$id>$title</option>";
}
 
 
 ?>


  


