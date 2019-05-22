<?php

class Thumbnail
{
    public static function resize()
    {
        require_once 'bootstrap.php';
        if (!empty($_POST['upload'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $tmp = explode('.', $_FILES['image']['name']);
            $file_ext = strtolower(end($tmp));

            $extensions = array('jpeg', 'jpg', 'png', 'gif');

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = 'extension not allowed, please choose a JPEG or PNG file.';
            }

            if ($file_size > 6291456) {
                $errors[] = 'File size must be excately 2 MB';
            }
            if (empty($errors) == true) {
                if (move_uploaded_file($file_tmp, 'images/'.$file_name)) {
                    $post = new Post();
                    $post->setImage($_FILES['image']['name']);
                    $post->setText(htmlspecialchars($_POST['text']));
                    $post->setFilter(htmlspecialchars($_POST['filter']));
                    $post->uploadPosts();
                    $colors = Post::detectColors($_FILES['image']['name']);
                    $orgfile = 'images/'.$_FILES['image']['name'];
                    list($width, $height, $type, $attr) = getimagesize($orgfile);

                    /*echo alles van de afbeelding
                    echo 'Width : '.$width.'<br>';
                    echo 'Height : '.$height.'<br>';
                    echo 'type :'.$type.'<br>';
                    echo 'attribute :'.$attr;
                    */

                    switch ($file_ext) {
                        case 'png':
                        $newfile = imagecreatefrompng($orgfile);
                        break;

                        case 'jpg':
                        $newfile = imagecreatefromjpeg($orgfile);
                        break;

                        case 'gif':
                            $newfile = imagecreatefromgif($orgfile);
                        break;

                        case 'jpeg':
                        $newfile = imagecreatefromjpeg($orgfile);
                        break;
                    }
                    //$newfile = imagecreatefrompng($orgfile);
                    $newWidth = $width / 2;
                    $newHeight = $height / 2;
                    $thumb = 'images/thumb/'.$_FILES['image']['name'];
                    $truecolor = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    //imagepng($truecolor, $thumb);

                    switch ($file_ext) {
                        case 'png':
                        imagepng($truecolor, $thumb);
                        break;

                        case 'jpg':
                        imagejpeg($truecolor, $thumb);
                        break;

                        case 'gif':
                        imagegif($truecolor, $thumb);
                        break;

                        case 'jpeg':
                        imagejpeg($truecolor, $thumb);
                        break;
                    }

                    header('location:index.php');
                }
            } else {
                print_r($errors);
            }
        }
    }
}
