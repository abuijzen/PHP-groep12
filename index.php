<?php
    require_once 'bootstrap.php';

    //zonder sessie niet naar index gaan.
    if (isset($_SESSION['email'])) {
    } else {
        header('location:login.php');
    }

    $post = new Post();
    $countResults = $post->countAll();
    $viewResults = $post->countViewable();
    $noResult = $post->noResult();

    if (!empty($_GET['color'])) {
        $color = $_GET['color'];
        $results = Post::getImagesWithSameColors($color);
    } else {
        $results = $post->showResults();
        // var_dump($results);
    }

?><!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Inspiration Hunter</title>
         
             <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="css/material-kit.css?v=2.0.5" rel="stylesheet">
        </head>
        <body>
            <?php include_once 'nav.php'; ?>
           
            <!--Formulier om te zoeken op input van gebruiker-->
            <form name='form-search' method='get' action="index.php" id="form-search">
                <input type="text" id="search" name="search" value="" placeholder="zoeken">
            </form>
            <h3 class="text-center">
                <?php
                //vraag post op met de meeste likes
                $mostLikes = Post::countLikes();
                $mostLikesPost = Post::getNowTrending($mostLikes);

                //tel de gevonden resultaten
                echo '<br>Found results: '.$countResults.'<br>';
                echo 'Viewable results: '.$viewResults;
                ?>
            </h3>
    
            <div class="card col-fluid text-center">
                <!--geeft de post met meeste likes-->
                <h2>NOW TRENDING</h2>
                    <?php foreach ($mostLikesPost as $trend):?>
                        <?php echo 'A post from: '.$trend['firstname']; ?> <?php echo $trend['lastname']; ?>
                            <a href="detail_img.php?id=<?php echo $trend[0]; ?>">
                                <img src="images/thumb/<?php echo $trend['image']; ?>" class="card-img-top " alt="" height="200" width="200" style="object-fit: cover" class="<?php echo $c['filter']; ?>">
                            </a>
                    <?php endforeach; ?>
            </div>
        <div class="post row">
            <!--indien er GEEN resultaten worden gevonden-->
            <?php echo $noResult; ?>
    
            <!--indien er WEL resultaten worden gevonden-->
            <?php if ($countResults >= 1): ?>
                <?php foreach ($results as $c): ?>
                <div class="col-md-3-fluid text-center card " style="width:25%;">
                
                    <div class="post"> 
                        <div class="inappropriate">
                            <a class="report" data-id="<?php echo $c['post_id']; ?>" href="#">
                                <img class="report_Icon" src="images/report.svg" alt="report icon">
                            </a>    
                        </div>
                        <a href="followProfile.php?id=<?php echo $c[0]; ?>">
                            <p><strong><?php echo $c['firstname']; ?> <?php echo $c['lastname']; ?></strong></p>
                        </a>
                        <p><?php echo Time::getTime($c['timePost']); ?></p>
                        <div class="image">
                            <a href="detail_img.php?id=<?php echo $c[0]; ?>">
                            <img src="images/thumb/<?php echo $c['image']; ?>" class="card-img-top " alt="" height="200" width="200" style="object-fit: cover" class="<?php echo $c['filter']; ?>">
                            </a>
                        </div>



                        <p><?php echo $c['message']; ?></p><a href="profile.php?user=<?php echo $c['usersId']; ?>">
                        </p></a>	  

                        
                        <div class="likePlace">
                            <a href="#" data-id="<?php echo $c['post_id']; ?>" class="likes btn btn-primary">thumb_u</a> 
                            <span class='likesAmount'><?php echo Like::getLikes($c['post_id']); ?></span> people liked this 
                        </div>

                    </div>    

                    </div>
                <?php endforeach; ?> 
            <?php endif; ?>  
            </div>
           
        </body>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>   
            <script src="js/report.js"></script>
            <script src="js/like.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </html>
