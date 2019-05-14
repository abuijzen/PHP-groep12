<?php

require_once 'bootstrap.php';

//niet zonder sessie naar upload kunnen gaan.
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

if (!empty($_POST['upload'])) {
    $post = new Post();

    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    // $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    $tmp = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($tmp));

    $extensions = array('jpeg', 'jpg', 'png', 'jpeg');

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = 'extension not allowed, please choose a JPEG or PNG file.';
    }

    if ($file_size > 1024 * 1024 * 2) {
        $errors[] = 'File size must be excately 2 MB';
    }

    //    move_uploaded_file($_FILES['file']['tmp_name'], 'images/'.$_FILES['file']['name']);

    if (empty($errors) == true) {
        if (move_uploaded_file($file_tmp, 'images/'.$file_name)) {
            $post->setImage($_FILES['image']['name']);
            $post->setText(htmlspecialchars($_POST['text']));
            $post->setFilter(htmlspecialchars($_POST['filter']));
            $post->uploadPosts();
            $orgfile = 'images/'.$_FILES['image']['name'];
            list($width, $height, $type, $attr) = getimagesize($orgfile);

            $newfile = imagecreatefrompng($orgfile);
            $newWidth = 300;
            $newHeight = 300;
            $thumb = 'images/thumb/'.$_FILES['image']['name'];
            $truecolor = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            echo '<br>File uploaded successfully and thumbnail created.';
            imagepng($truecolor, $thumb);
            header('location:index.php');
        }
    } else {
        print_r($errors);
    }
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
                <select name="filter">
                    <option value="Kies filter" disabled>Kies filter</option>
                    <option value="rise">rise</option>
                    <option value="_1977">old look</option>
                    <option value="toaster">summer</option>
                    <option value="willow">grayscale</option>
                    <option value="">geen filter</option>
                </select>

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
