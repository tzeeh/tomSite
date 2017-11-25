<?php 
include('functions.php');
$columns = array(
  "post_date",
  "post_content"
  
);
$conditions = array(
  "ID"=>693
);
print_r(easyData('select','posts', $columns,$conditions));

?>
