<?php
  function connectDB() {
      if(file_get_contents("config.json")){
        $contents = file_get_contents("config.json");
        $creds = json_decode($contents,true);
        $hostname = $creds["hostname"];
        $database = $creds["database"];
        $username = $creds["username"];
        $password = $creds["password"];
        try {
          $dbc = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
          } catch (PDOException $e) {
          echo "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      } else{
        echo "No config.json file found";
    }
  return $dbc;
  
  }
function encrypt(){
  
}
?>