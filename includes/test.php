<?php 
include_once("functions.php");
if($_SERVER['HTTP_HOST']=='localhost'){
    $includePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'tomSite'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR;
}
else{
    $includePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR;
}
echo $includePath;
?>
