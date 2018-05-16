<h1>Blog</h1>
<?php include('php/functions.php');
$_SESSION['offset'] = 0;
$_SESSION['count'] = 5;
$sql = 
"SELECT
  p.title,
  p.content,
  p.date_entered,
  p.tags,
  u.display_name
FROM posts p
INNER JOIN users u
ON p.author = u.id
LIMIT {$_SESSION['offset']} , {$_SESSION['count']}";

  $response = ezCustom($sql);
  if($response['success'] && $response['data']){
    $results = $response['data'];
    foreach($results as $result){
      $html .= "
      <h2><a href='#'>{$result['title']}</a></h2>
      <span class='glyphicon glyphicon-calendar'></span>
      <span class='label label-default'>{$result['date_entered']}</span>
      <span class='glyphicon glyphicon-pencil'></span>
      <span class='label label-default'>{$result['display_name']}</span>
      <span class='glyphicon glyphicon-search'></span>
      <span class='label label-default'>{$result['tags']}</span>
      <br>
      {$result['content']}
      <br>";
    }
}
echo $html;
  ?>
<hr>
<br>
<br>
<div id="moreBlogPosts"></div>
<br>
<button id="btnLoadPosts" class="btn btn-default" onClick="loadMorePosts()" type="button">Load More Posts</button>
