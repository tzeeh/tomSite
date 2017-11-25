<?php 
set_include_path('/opt/lampp/htdocs/tom/tomsSite/includes/');
include_once("functions.php");
  $dbh = connectDB();
  $sql = "SELECT u.display_name,
                 p.post_date,
                 p.post_content,
                 p.post_title
          FROM posts p
          INNER JOIN users u
          ON p.post_author = u.id
          WHERE post_status = 'publish'
          ORDER BY post_date DESC
          LIMIT 5
          ";
  $sth = $dbh->prepare($sql);
  $sth->execute();
  $row = array();
  while($row = $sth->fetch(PDO::FETCH_ASSOC)):?>    

    <h2><? echo $row['post_title'] ?></h2>
    <span class='label label-default'><?echo $row['post_date']?></span>
    <span class='label label-default'><?echo $row['display_name']?></span>
    <br>
    <br>
    <?echo $row['post_content']?>
  <?endwhile;?>


  


