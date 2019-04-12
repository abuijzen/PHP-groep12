<?php

//upload moet iets bevatten
if(!empty($_FILES['image']['name'])){

// pad waar afbeelding wordt opgeslagen
$target= "images/".basename($_FILES['image']['name']);

//krijg data die gesubmitted is
$image = $_FILES['image']['name'];
$text = (htmlspecialchars($_POST['text']));

$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$insert = $conn->prepare("INSERT INTO tl_picture(image, text) VALUES (:image, :text)");
try{
    if(!$insert->execute(array(':image' => $image, ':text' => $text)))
        die("Unknown ERROR!");
} catch(PDOException $ex) {
    die($e->getMessage());
}

//zet de geüploadede afbeelding in de map "images"
if (move_uploaded_file($_FILES['image']['tmp_name'],$target)){
    echo"afbeelding is opgeslagen";
}else{
    echo"afbeelding is niet opgeslagen";
}
//als de afbeelding niet is gekozen ->empty
}else{
    echo "Er is iets foutgelopen";
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Image</title>
</head>
<body>
    <?php include_once("nav.php"); ?>
<div id="content">

<!--Upload formulier-->

        <!--zonder enctype kan je geen file uploaden-->
        <form method="post" action ="upload.php" enctype="multipart/form-data">
        

            <input type="hidden" name="size" value="100000">
            <div>
                <!--HTML5 code die ervoor zorgt dat je op je gsm rechtstreeks een foto kan maken-->
                <input type="file" name="image" accept="image/*" capture="camera"/>
            </div>
            <div>
                <textarea name="text" cols="40" rows="4" placeholder="Wat wil je zeggen over jouw post?"></textarea>
            </div>
            <div>
                <input type="submit" name="upload" value = "Posten">
            </div>
</form>


<!--alle posts laten zien-->
<?php
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$statement = $conn->prepare("SELECT * FROM tl_picture");
$statement->execute();
$collection = $statement->fetchAll();
?> 
<div class="all-posts">
<?php foreach($collection as $c): ?>
<div class="post">
<a href="detail-img.php"><img src="images/<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
<p><?php echo $c['text']; ?></p>
</div>
<?php endforeach; ?>
</div>


<style>


form{
    width:100%;
    padding:30px;
    background-color:#999;
    margin: 10px 0px;
}
.all-posts{
    margin-top:40px;
    display:flex;
    flex-wrap:wrap;
    justify-content:left;
}

.post p{
font-weight:100;
font-family:sans-serif;
margin-left:25px;
}

img{
    margin:5px;
}

</style>

</body>
</html>
