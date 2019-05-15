<?php
    require_once 'bootstrap.php';

    //zonder sessie niet naar index gaan.
    if (isset($_SESSION['email'])) {
    } else {
        header('location:login.php');
    }

    //gebruik van klassen
    $post = new Post();
?><!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Inspiration Hunter</title>
         
             <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"
        />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="css/material-kit.css?v=2.0.5" rel="stylesheet" />
        </head>
        <body>
            <?php include_once 'nav.php'; ?>
           
            <!--Formulier om te zoeken op input van gebruiker-->
            <form name='form-search' method='get' action="index.php" id="form-search">
                <input type="text" id="search" name="search" value="" placeholder="zoeken">
            </form>
            <h1 class="text-center">
            <?php
            //tel de gevonden resultaten
            echo '<br>Found results: '.$post->countAll().'<br>';
            echo 'Viewable results: '.$post->countViewable();

            ?></h1>

<div class="post row">
            <!--indien er GEEN resultaten worden gevonden-->
            <?php echo $post->noResult(); ?>
    
            <!--indien er WEL resultaten worden gevonden-->
            <?php if ($post->countAll() >= 1): ?>
                <?php foreach ($post->showResults() as $c): ?>
                <div class="col-md-3-fluid text-center card " style="width:25%;">
                    <div class="post"> 
                        <div class="image">

                             

                        <a href="detail_img.php?id=<?php echo $c[0]; ?>">
                            <img src="images/thumb/<?php echo $c['image']; ?>" class="card-img-top " alt="" height="200" width="200" style="object-fit: cover" class="<?php echo $c['filter']; ?>">
                            </a>
                        </div>
                        <p><?php echo $c['message']; ?></p>	  
                        <p><?php echo $c['firstname']; ?></p>	                      
                        <p><?php echo Time::getTime($c['timePost']); ?></p>
                        <div class="likePlace">
                            <a href="#" data-id="<?php echo $c['id']; ?>" class="likes btn btn-primary">thumb_u</a> 
                            <span class='likesAmount'><?php echo Like::getLikes($c['id']); ?></span> people liked this 
                        </div>
                    </div>    

                    </div>
                <?php endforeach; ?> 
            <?php endif; ?>  
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>   
            <script src="js/like.js"></script>
        </body>
    </html>
