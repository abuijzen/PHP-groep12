<?php
    require_once 'bootstrap.php';

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
                        <a href="detail_img.php?id=<?php echo $c['id']; ?>">
                            <img src="images/<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover">
                        </a>
                        <p><?php echo $c['message']; ?></p>
                        <?php date_default_timezone_set('Europe/Brussels');
                            // datum vandaag
                            $vandaag = date('Y-m-d');

                            // datum + tijd vandaag
                            $vandaagDateTime = date('Y-m-d H:i:s ');

                            //net gepost
                            $nuTime = date('H:i:s', strtotime('-1 sec'));

                            // datum gisteren
                            $yesterday = date('Y-m-d', strtotime('-1 days'));

                            // vanaf meer dan 1 dag geleden
                            $eergisteren = date('Y-m-d', strtotime('-2 days'));

                            // datum + tijd van de upload
                            $uploadDateTime = date('Y-m-d H:i', strtotime($c['timePost']));

                            // datum van de upload
                            $uploadTime = date('H:i', strtotime($c['timePost']));

                            // datum van de upload
                            $uploadDate = date('Y-m-d', strtotime($c['timePost']));

                            //half uur geleden
                            $halfHourAgo = date('H:i', strtotime('-30 min'));

                            //15 min geleden
                            $quarterAgo = date('H:i', strtotime('-15 min'));

                            //een uur geleden
                            $hourAgo = date('H:i', strtotime('-1 hour'));

                            //2 uur geleden
                            //$twoHoursAgo =date('H:i',strtotime("-2 hour"));

                            // Is de post gisteren geplaatst?
                            if ($uploadDate == $yesterday) {
                                echo 'gisteren gepost om: '.date('H:i', strtotime($uploadTime)).'<br>';
                            }

                            //eergisteren gepost?
                            if ($uploadDate <= $eergisteren) {
                                echo $uploadDateTime;
                            }

                            // ---------indien vandaag gepost: meerdere opties van mededelingen ----------
                            switch ($uploadDate == $vandaag) {
                            //meer dan een uur geleden gepost
                            case $uploadTime < $hourAgo:
                                echo'<br>1 uur geleden<br>';
                            break;

                            //meer dan een half uur geleden
                            case $uploadTime < $halfHourAgo:
                                echo '<br>Half uur geleden<br>';
                            break;

                            //minder dan een kwartier
                            case $uploadTime < $nuTime:
                                echo '<br>Zonet<br>';
                            }
                        ?>
                        <br>
                        <div class="likePlace">
                            <a href="#" data-id="<?php echo $c['id']; ?>" class="likes">Like</a> 
                            <span class='likes'><?php echo LikePost::getLikes($c['id']); ?></span> people liked this 
                        </div>
                    </div>    
                <?php endforeach; ?> 
            <?php endif; ?>  
            <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>   
            <script src="js/like.js"></script>
        </body>
    </html>