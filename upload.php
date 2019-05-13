<?php

require_once 'bootstrap.php';

//niet zonder sessie naar upload kunnen gaan.
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

$post = new Post();

$errors = array();
if (!empty($_FILES['image']['name'])) {
    $post->setImage($_FILES['image']['name']);
    $post->setText(htmlspecialchars($_POST['text']));
    $post->setFilter(htmlspecialchars($_POST['filter']));
    $post->uploadPosts();
    //get provided file information
    $fileName = $_FILES['image']['name'];
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

    //do other validations here if you need more

    //error array moet leeg zijn
    if (empty($errors)) {
        move_uploaded_file($fileTmp, 'images/'.$fileName);
        echo 'File uploaded successfully.';
        header('Location:index.php');
    } else {
        echo 'Some Error Occured: <br>'.implode('<br>', $errors);
    }
} else {
    $errors[] = 'No Image is provided.';
}

/*//function to create thumbnail
create_thumb($target,$ext,$thumb_path,$w,$h){
        list($w_orig,$h_orig)=getimagesize($target);
        $scale_ratio=$w_orig/$h_orig;
        if(($w/$h)>$scale_ratio)
            $w=$h*$scale_ratio;
        else
            $h=$w/$scale_ratio;

    if($w_orig<=$w){
        $w=$w_orig;
        $h=$h_orig;
    }
    $img="";
    if($ext=="gif")
        $img=imagecreatefromgif($target);
    else if($ext=="png")
        $img=imagecreatefrompng($target);
    else if($ext=="jpg")
        $img=imagecreatefromjpeg($target);

    $tci=imagecreatetruecolor($w,$h);
    imagecopyresampled($tci,$img,0,0,0,0,$w,$h,$w_orig,$h_orig);
    imagejpeg($tci,$thumb_path,80);
    imagedestroy($tci);
}
*/

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
