<?php 
include('functions.php');

$hash = encrypt("tnXDk0YmCOyKisk9");
echo $hash;

if (password_verify("test", $hash )){
  echo '</br>';
  echo 'password matches';
}
else{
  echo '</br>';
  echo 'password does not match';
}



?>
