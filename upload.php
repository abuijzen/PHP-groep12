<?php

//link naar classe Post
require_once("classes/post.class.php"); 

//upload moet iets bevatten
if(!empty($_FILES['image']['name'])){

// pad waar afbeelding wordt opgeslagen
$target= "images/".basename($_FILES['image']['name']);

//new post maken
$post = new Post();
$post->setImage($_FILES['image']['name']);
$post->setText(htmlspecialchars($_POST['text']));
$post->getSubmittedPosts();

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
<!--ajax inladen-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--navigatie inladen-->
<header>

<?php include_once("nav.php"); ?> 
<form name='form-search' method='post' action="testing2.php" id="form-search">
<input type="text" id="search" name="search" value="zoeken">
</form
</header>
<div id="content">
<!--Upload formulier-->

        <!--zonder enctype kan je geen file uploaden-->
        <form method="post" action ="upload.php" enctype="multipart/form-data" id="form-input">
        
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
//feature 7: limit in sql

$limit = 20;
//$innerhtml=$POST_['search'];
$innerhtml="e";
$statement = $conn->prepare("SELECT * FROM tl_picture WHERE text LIKE '%$innerhtml%' LIMIT 20");
$statement->execute();
$collection = $statement->fetchAll();
?> 
<div class="all-posts">
<?php foreach($collection as $c): ?>

<div class="post">

<a href="detail-img.php?id=<?php echo $c['id']; ?>"><img src="images/<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
<p><?php echo $c['text']; ?></p>

</div>
<?php endforeach; ?>

</div>
<span id="<?php echo $collection['id']; ?>" class="show_more" title="Load more posts">Show more</span>

<style>


#form-input{
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

header{
    display:flex;
    height:200px;
    background-color:#000;
}

#form-search{
    position:absolute;
    right:20px;
    width:200px;
}

</style>

</body>
</html>
