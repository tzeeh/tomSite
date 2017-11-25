<?php

  function connectDB() {
      if(file_get_contents('/opt/lampp/htdocs/tom/config.json')){
        $contents = file_get_contents('/opt/lampp/htdocs/tom/config.json');
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
  
  function easyData ($action , $table, $columns,$conditions=null,$limit=null ) {
    $results = array(
      "success"=>true,
      "error"=>false
    );
    if ($action == "select") {
      $dbh = connectDB();
      $sql = "SELECT ";
      for ($i = 0;$i < count($columns); $i++){
        if($i == count($columns)-1){
          $sql.= $columns[$i];  
        }
        else{
          $sql.= $columns[$i].",";
        }
      }
      $sql.= " FROM $table";
        if (!empty($conditions)){
          $sql.=" WHERE ";
          $count = 0;
          foreach ($conditions as $key => $value){
            $count++;
            if($count >= count($conditions)){
              $sql.= "$key = ?";
              
            }
            else{            
              $sql.= "$key = ? and ";
            }
          }
        }
        if( !empty($limit)){
          $sql.= " LIMIT ".$limit;
        }
        try {
          $sth = $dbh->prepare($sql);
          $sth->execute(array_values($conditions));
          $row = array();
          while($row = $sth->fetch(PDO::FETCH_ASSOC)){
              $data[]= $row;
            }
            $results['data'] = $data;
        }
        catch (PDOException $e) {
          $results = array(
            "success"=>false,
            "error"=>$e->getMessage()
          );          
        }   
        return $results; 
    }
    elseif ($action == "update") {
      $dbh = connectDB();
      $sql = "UPDATE $table";
      $sql .= " SET ";
      $count = 0;
      foreach($columns as $key => $value){
        $count++;
        if($count >= count($columns)){
          $sql.= "$key = ?";
        }
        else{
          $sql.= "$key = ?,";
        }
      }
      if (!empty($conditions)){
        $sql.=" WHERE ";
        $count = 0;
        foreach ($conditions as $key => $value){
          $count++;
          if($count >= count($conditions)){
            $sql.= "$key = ?";
            
          }
          else{            
            $sql.= "$key = ? and ";
          }
        }
      }
      try {
        $colValues = array_values($columns);
        $condValues = array_values($conditions);
        $sth = $dbh->prepare($sql);
        $sth->execute(array_merge($colValues,$condValues));
      }
      catch (PDOException $e) {
        $results = array(
          "success"=>false,
          "error"=>$e->getMessage()
        );
        
      }
      return $results;
  
    }
    elseif ($action == "insert"){
      $dbh = connectDB();
      $sql = "INSERT INTO $table ( ";
      $count = 0;
      foreach($columns as $key => $value){
        $count++;
        if($count >= count($columns)){
          $sql.= "$key ";
        }
        else{
          $sql.= "$key, ";
        }
  
      }
      $sql.= ") VALUES ( ";
      $count = 0;
      foreach($columns as $key => $value){
        $count++;
        if($count >= count($columns)){
          $sql.= "? ";
        }
        else{
          $sql.= "?, ";
        }
  
      }
      $sql .= ")";
      try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array_values($columns));
      }
      catch (PDOException $e) {
        $results = array(
          "success"=>false,
          "error"=>$e->getMessage()
        );
        
      }
      return $results;
  
    }
    else {
      return "First Paramater wrong.....";
    }
  }
  function encrypt($str){        
    
    return password_hash($str, PASSWORD_DEFAULT);
  }
?>