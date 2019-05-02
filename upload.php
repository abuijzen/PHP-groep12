<?php

//link naar classe Post
// require_once 'classes/Post.class.php';
require_once 'bootstrap.php';

//upload moet iets bevatten
if (!empty($_FILES['image']['name'])) {
    // pad waar afbeelding wordt opgeslagen
    $target = 'images/'.basename($_FILES['image']['name']);

    //new post maken
    $post = new Post();
    $post->setImage($_FILES['image']['name']);
    $post->setText(htmlspecialchars($_POST['text']));
    $post->uploadPosts();

    //zet de geüploadede afbeelding in de map "images"
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo'afbeelding is opgeslagen';
        header('Location:index.php');
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
    <link rel="stylesheet" href="css/screen.css">
</head>
<body>
<!--ajax inladen-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--navigatie inladen-->
    <?php include_once 'nav.php'; ?> 
    <h2>Upload image</h2>
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
                <input type="submit" name="upload" value ="Posten">
            </div>
        </form>
</body>
</html>
