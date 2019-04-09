<?php 
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$imageId=$_GET['id'];
$statement = $conn->prepare("SELECT * FROM tl_picture where tl_picture.id='.$imageId.'");
$statement->execute();
$collection = $statement->fetchAll();


?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Spotify</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  
  
  <?php include_once("nav.php"); ?>
  
  <div class="collectionDetails" style="background-image: linear-gradient(to right, rgba(0,0,0,1) 0%,rgba(255,255,255,0) 100%), url(<?php echo $collection['cover']; ?>)">
    <h1 class="collectionDetails__title"><?php echo $collection['text'];?></h1>
    <img src="<?php echo $collection[$id]['image'];?>" alt="">
    

</div>

</body>
</html>