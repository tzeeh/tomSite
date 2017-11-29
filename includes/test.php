<?php 
set_include_path('/opt/lampp/htdocs/tom/tomsSite/includes/');
include_once("functions.php");


$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo $actual_link;
?>
