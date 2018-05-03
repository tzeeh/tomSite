<?php 
include_once("functions.php");
$table = "users";
$columns = array(
    "user_login",
    "user_pass"  
);
$conditions = array(
    "ID"=>1
);
$data = ezSelect($table,$columns);
print_r($data['entries']);
?>
