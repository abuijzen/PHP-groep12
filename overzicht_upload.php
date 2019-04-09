<?php

$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$statement = $conn->prepare("SELECT * FROM tl_picture");
$statement->execute();
$collection = $statement->fetchAll();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php foreach($collection as $c): ?>
<a href="detail-img.php"><img src="<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
<p><?php echo $c['text']; ?></p>
<?php endforeach; ?>
</body>
</html>

