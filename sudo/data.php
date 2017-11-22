<?php 
include_once("functions.php");
  $dbh = connectDB();
  $sql = "SELECT post_author,
                 post_date,
                 post_content,
                 post_title
          FROM posts
          WHERE post_status = 'publish'
          AND post_type = 'post'
          LIMIT 5
          ";
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $row = array();
  while($row = $sth->fetch(PDO::FETCH_ASSOC)):?>    

    <h2><? echo $row['post_title'] ?></h2>
    <span class='label label-default'><?echo $row['post_date']?></span>
    <span class='label label-default'><?echo $row['post_author']?></span>
    <br>
    <?echo $row['post_content']?>
  <?endwhile;?>


  


