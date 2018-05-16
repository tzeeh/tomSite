<?php include('php/functions.php');
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
WHERE p.url_name = ?";
$param = array($_GET['url_name']);
  $response = ezCustom($sql, $param);
  if($response['success'] && $response['data']){
    $results = $response['data'];
    foreach($results as $result){
      $html .= "
      <h1> {$result['title']} ;</h1>
      <h3>By: {$result['display_name']};</h3>
      <hr>
      <p>Posted on {$result['date_entered']};</p>
      <p>Categories: {$result['tags']};</p>
      {$result['content']}";
    }
}
echo $html;

?>