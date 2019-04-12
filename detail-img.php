<?php 
require_once("classes/post.class.php");
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$id=$_GET['id'];
$statement = $conn->prepare("SELECT * FROM tl_picture where id='.$id.'");
$statement->execute();
$collection = $statement->fetchAll();



if (!empty($_GET["id"])) {
  $id = $_GET["id"];
  echo ($id);
} 


 
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>full view</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  <?php include_once("nav.php"); ?>
  
 


</body>
</html>