<?php 
include_once("functions.php");


$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $actual_link;
$table = "posts";
$columns = array(
    "ID"    
);
$data = ezSelect($table,$columns);
print_r($data);
?>
