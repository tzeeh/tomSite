<?php 
set_include_path('/opt/lampp/htdocs/tom/tomsSite/includes/');
include_once("functions.php");
$columns = array(
  "id",
  "post_title"
  
);
$orderBy = array(
  "post_date"=>"desc"
);
$results = ezSelect('posts', $columns,null,null,null,$orderBy);
foreach ($results['entries'] as $result){
  $id = $result['ID'];
  $title = $result['post_title'];
  echo "<option value=$id>$title</option>";
}
 
 
 ?>


  


