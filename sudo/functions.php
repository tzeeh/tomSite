<?php
  function connectDB() {
      if(file_get_contents("config.json",FILE_USE_INCLUDE_PATH)){
        $contents = file_get_contents("config.json");
        $creds = json_decode($contents,true);
        $hostname = $creds["hostname"];
        $database = $creds["database"];
        $username = $creds["username"];
        $password = $creds["password"];
        try {
          $dbc = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
          } catch (PDOException $e) {
            return "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      } else{
        return "No config.json file found";
    }
  return $dbc;
  
  }
  function encrypt($str){        
    
    return password_hash($str, PASSWORD_DEFAULT);
  }
?>