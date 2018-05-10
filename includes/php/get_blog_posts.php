<?php 
include_once("functions.php");
if(!isset($_GET['post_name'])){
  $_GET['post_name']='';
}
$dbh = connectDB();
$sql = "SELECT u.display_name,
               DATE_FORMAT(p.post_date,'%M %d, %Y') as post_date,
               p.post_content,
               p.tags,
               p.post_title
        FROM posts p
        INNER JOIN users u
        ON p.post_author = u.id
        WHERE p.post_status = 'publish'
        AND p.post_name = ?
        ";
$sth = $dbh->prepare($sql);
$sth->execute(array($_GET['post_name']));
$results = $sth->fetch(PDO::FETCH_ASSOC);
if (!empty($results)): ?>
<h1><?php echo $results['post_title'] ?>;</h1>
<h3>By: <?php echo $results['display_name']?>;</h3>
<hr>
<p>Posted on <?php echo $results['post_date']?>;</p>
<p>Categories: <?php echo $results['tags']?>;</p>
<hr>
    <br>
    <br>
    <?php echo $results['post_content']?>
<?php else:
$sql = "SELECT u.display_name,
                 DATE_FORMAT(p.post_date,'%M %d %Y') as post_date,
                 p.post_content,
                 p.tags,
                 p.post_title,
                 p.post_name
          FROM posts p
          INNER JOIN users u
          ON p.post_author = u.id
          WHERE post_status = 'publish'
          ORDER BY post_date DESC
          LIMIT :offset , :numberPosts 
          ";
  $sth = $dbh->prepare($sql);
  $sth->bindValue(':offset', (int) trim($_GET['offset']), PDO::PARAM_INT);
  $sth->bindValue(':numberPosts', (int) trim($_GET['numOfPostLoad']), PDO::PARAM_INT);
  $sth->execute();
  $row = array();
  while($row = $sth->fetch(PDO::FETCH_ASSOC)):?>    
    <h2><a href="?post=<?php echo$row['post_name']?>"><?php echo $row['post_title'] ?></a></h2>
    <span class="glyphicon glyphicon-calendar"></span>
    <span class='label label-default'><?php echo $row['post_date']?></span>
    <span class="glyphicon glyphicon-pencil"></span>
    <span class='label label-default'><?php echo $row['display_name']?></span>
    <span class="glyphicon glyphicon-search"></span>
    <span class='label label-default'><?php echo $row['tags']?></span>
    <br>
    <br>
    <?php echo $row['post_content']?>
  <?php endwhile;?>

<?php endif;?>