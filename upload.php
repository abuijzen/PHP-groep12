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
    if (!empty($_FILES['image']['name']) && !empty($_POST['text'])) {
        $post->setImage($_FILES['image']['name']);
        $post->setText(htmlspecialchars($_POST['text']));
        $post->setFilter(htmlspecialchars($_POST['filter']));
        $post->uploadPosts();
        //get provided file information
       /* $fileName = $_FILES['image']['name'];
        $fileExtArr = explode('.', $fileName); //make array of file.name.ext as    array(file,name,ext)
        $fileExt = strtolower(end($fileExtArr)); //get last item of array of user file input
        $fileSize = $_FILES['image']['size'];
        $fileTmp = $_FILES['image']['tmp_name'];

        //which files we accept
        $allowed_files = ['jpg', 'png', 'gif'];

        //validate file size
        if ($fileSize > (1024 * 1024 * 2)) {
            $errors[] = 'Maximum 2MB files are allowed';
        }

        //validating file extension
        if (!in_array($fileExt, $allowed_files)) {
            $errors[] = 'only ('.implode(', ', $allowed_files).') files are allowed.';
        }

        //als er geen errors zijn = array error leeg -> image uploaden
        if (empty($errors)) {
            move_uploaded_file($fileTmp, 'images/'.$fileName);
            //$orgfile = $_FILES['image']['tmp_name'];
*/
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/'.$_FILES['file']['name']);
            /*
            $orgfile= 'images/'.$_FILES['file']['name']
            list($width, $height) = getimagesize($orgfile);
            //$newfile = imagecreatefromjpeg($orgfile);
            $newfile = imagecreatefrompng($orgfile);
            $newWidth = 300;
            $newHeight = 300;
            $thumb = 'images/thumb'.$_FILES['image']['name'];
            $truecolor = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newHeight, $newWidth, $height);
            echo 'File uploaded successfully.';*/
            header('Location:index.php');
        } else {
            echo 'Some Error Occured: <br>'.implode('<br>', $errors);
        }
    } elseif (empty($_FILES['image']['name']) || empty($_POST['text'])) {
        echo 'niet alle velden zijn ingevuld';
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
