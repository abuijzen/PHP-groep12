<?php
    require_once 'bootstrap.php';
    //links
    // $conn = new PDO('mysql:host=localhost;dbname=eurben', 'root', 'root', null);
    // require_once 'classes/Post.class.php';
    // require_once 'classes/Date.class.php';
    //nu worden via bootstrap.php alle functies automatisch ingeladen.

    //zonder sessie niet naar index gaan.
    if (isset($_SESSION['email'])) {
    } else {
        header('location:login.php');
    }

    //gebruik van klassen
    $post = new Post();
    // $date = new Date();
?><!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Inspiration Hunter</title>
            <link rel="stylesheet" href="css/screen.css">
        </head>
        <body>
            <?php include_once 'nav.php'; ?>
            <h1>Inspiration Hunter</h1>
            <!--Formulier om te zoeken op input van gebruiker-->
            <form name='form-search' method='get' action="index.php" id="form-search">
                <input type="text" id="search" name="search" value="" placeholder="zoeken">
            </form>
            <?php
            //tel de gevonden resultaten
            echo '<br>Found results: '.$post->countAll().'<br>';
            echo 'Viewable results: '.$post->countViewable();
            ?>


            <!--indien er GEEN resultaten worden gevonden-->
            <?php echo $post->noResult(); ?>

            <!--indien er WEL resultaten worden gevonden-->
            <?php if ($post->countAll() >= 1): ?>
                <?php foreach ($post->showResults() as $c): ?>
                    <div class="post">
                        <a href="detail_img.php?id=<?php echo $c['id']; ?>"><img src="images/<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
                        <p><?php echo $c['message']; ?></p>
                        <br>
                        <div><a href="#" class="likes">Like</a><span class='likes'>xxx</span> people like this </div>
                        </div>
                        
                <?php endforeach; ?> 
                   
                
            <?php endif; ?>

                   
        </body>
    </html>