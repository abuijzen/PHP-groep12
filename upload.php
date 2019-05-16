<?php

require_once 'bootstrap.php';

//niet zonder sessie naar upload kunnen gaan.
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

Thumbnail::resize();

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Upload Image</title>
         <!--     Fonts and icons     -->
         <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
        />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="css/material-kit.css?v=2.0.5" rel="stylesheet" />
    </head>

    <body>

        <!--navigatie inladen-->
        <?php include_once 'nav.php'; ?>
        <div class="main main-raised">
        <div class="text-center">
        <h2>Upload image</h2>


<div id="row">
        
            <!--Upload formulier-->
            <!--zonder enctype kan je geen file uploaden-->
            <form method="post" action="upload.php" enctype="multipart/form-data" id="form-input">
                <input type="hidden" name="size" value="100000">
                <div>
                    <!--HTML5 code die ervoor zorgt dat je op je gsm rechtstreeks een foto kan maken-->
                    <input type="file" name="image" accept="image/*" capture="camera" />
                </div>
                <div>
                    <select class="form-control selectpicker" name="filter">
                        <option value="Kies filter" disabled>Kies filter</option>
                        <option value="rise">rise</option>
                        <option value="_1977">old look</option>
                        <option value="toaster">summer</option>
                        <option value="willow">grayscale</option>
                        <option value="">geen filter</option>
                    </select>

                </div>
                <div>
                    <textarea class="form-control" name="text" cols="40" rows="4" placeholder="Wat wil je zeggen over jouw post?"></textarea>
                </div>
                <div>
                    <input type="submit"  class="btn btn-primary" name="upload" value="Posten">
                </div>
            </form>
            </div>
        </div>
        </div>
    </body>

    </html>