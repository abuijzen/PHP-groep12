<?php

require_once '../bootstrap.php';
$output = '';

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($connect, $_POST['query']);
    $query = "
  SELECT * FROM posts 
  WHERE message LIKE '%".$search."%'
 ";
} else {
    $query = '';
}
$result = mysqli_query($connect, $query);
