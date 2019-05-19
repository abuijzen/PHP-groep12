<?php
require_once 'bootstrap.php';

//zonder sessie niet naar detailpagina gaan.
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

$post = new Post();

//select image waarop je geklikt hebt
if (!empty($_GET['id'])) {
    $id = ($_GET['id']);
    $selectId = Post::getSelectedImage($id);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Inspiration Hunter</title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="css/material-kit.css?v=2.0.5" rel="stylesheet">
    </head>
    <body class="profile-page sidebar-collapse">
        <?php include_once 'nav.php'; ?>
        <div class="page-header"></div>
            <div class="main main-raised">
                <div class="profile-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto">
                                <div class="profile">
                                    <?php echo 'Profile from: <strong>'.$selectId[0]['firstname']; ?> <?php echo $selectId[0]['lastname']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="description text-center">
                            <div class="profile__user--btns"></div>
                            <a href="index.php"><div class="btn btn-primary" data-post="">FOLLOW</div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>