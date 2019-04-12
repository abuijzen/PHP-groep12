<?php 



if (!empty($_GET["id"])) {
  $id = ($_GET["id"]);
  $conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
  $selectId = $conn->prepare("SELECT * FROM tl_picture where id='84'");
  $selectId->execute();
  $selectId = $selectId->fetchAll(PDO::FETCH_OBJ);
  var_dump($selectId);
  echo ("<br><br>ID die wordt meegegeven met de url: ".$id."<br>");
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
  
  
  <img src="images/<?php echo $selectId[$id]['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
  <p><?php echo $selectId[$id]['text'] ?></p>


</body>
</html>