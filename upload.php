<?php

//link naar classe Post
require_once 'classes/Post.class.php';

//upload moet iets bevatten
if (!empty($_FILES['image']['name'])) {
    // pad waar afbeelding wordt opgeslagen
    $target = 'images/'.basename($_FILES['image']['name']);

    //new post maken
    $post = new Post();
    $post->setImage($_FILES['image']['name']);
    $post->setText(htmlspecialchars($_POST['text']));
    $post->getSubmittedPosts();

    //zet de geüploadede afbeelding in de map "images"
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo'afbeelding is opgeslagen';
    // location header redirect
    } else {
        echo'afbeelding is niet opgeslagen';
    }
    //als de afbeelding niet is gekozen ->empty
} else {
    echo 'Er is iets foutgelopen';
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

<?php include_once 'nav.php'; ?> 
<form name='form-search' method='get' action="index.php" id="form-search">
<input type="text" id="search" name="search" value="" placeholder="zoeken">
</form>
<?php
?>

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




<body>



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
    height:200px;
    position:relative;
}

#form-search{
    position:absolute;
    right:10px;
    top:0px;
    background-color:#000;
}

</style>

</body>
</html>
