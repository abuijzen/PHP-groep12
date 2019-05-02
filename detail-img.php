<?php 

if (!empty($_GET["id"])) {
  $id = ($_GET["id"]);
  $conn = new PDO("mysql:host=localhost;dbname=eurben","root","root",null);
  $selectId = $conn->prepare("SELECT * FROM picture where id='$id'");
  $selectId->execute();
  $selectId = $selectId->fetchAll(PDO::FETCH_ASSOC);
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
  
  <img src="images/<?php echo $selectId[0]['image']; ?>" alt="" height="auto" width="50%" style="object-fit: cover"></a>
  <p><?php echo $selectId[0]['text'] ?></p>

<style>

p{
  font-family:sans-serif;
  font-weight:100;
  margin-left:40px;
}
img{
  margin:40px 0px 0px 40px;
  
}
</style>

</body>
</html>
