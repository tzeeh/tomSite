<?php
var_dump(connectDB());
  function connectDB() {
      if(file_get_contents('/opt/lampp/htdocs/tomSite/config.json')){
        $contents = file_get_contents('/opt/lampp/htdocs/tomSite/config.json');
        $creds = json_decode($contents,true);
        print_r($creds);
        $hostname = $creds["hostname"];
        $database = $creds["database"];
        $username = $creds["username"];
        $password = $creds["password"];
        try {
          $dbc = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
          } catch (PDOException $e) {
            return "Error!: " . $e->getMessage() . "<br/>";
          die();
        }
      } else{
        return "No config.json file found";
    }
  return $dbc;
  
  }
  function ezInsert ($table, $columns) {
    $results = array(
      "success"=>true,
      "error"=>false
    );
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
  function ezSelect ($table, $columns,$conditions=null,$limit=null,$orderBy=null) {
    $results = array(
      "success"=>true,
      "error"=>false
    );
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
        if( !empty($orderBy)){
          foreach($orderBy as $key => $value){
            $sql.= " ORDER BY $key $value";
          }
        }
        try {
          $sth = $dbh->prepare($sql);
          $sth->execute(array_values($conditions));
          $row = array();
          $data = array();
          $data = $sth->fetchAll(PDO::FETCH_ASSOC);
          $results['entries'] = $data;
        }
        catch (PDOException $e) {
          $results = array(
            "success"=>false,
            "error"=>$e->getMessage()
          );          
        }   
        return $results; 

      }
  function ezUpdate ($table, $columns,$conditions) {
    $results = array(
      "success"=>true,
      "error"=>false
    );
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
  
  function encrypt($str){        
    
    return password_hash($str, PASSWORD_DEFAULT);
  }
?>