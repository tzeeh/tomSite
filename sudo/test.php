<?php 

$contents = file_get_contents("config.json");
$creds = json_decode($contents,true);

$hostname = $creds["hostname"];
$database = $creds["database"];
$username = $creds["username"];
$password = $creds["password"];
try {
  $dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
  foreach($dbh->query("SELECT * from posts WHERE post_status = 'publish'") as $row) {
      print_r($row);
  }
  $dbh = null;
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}


?>