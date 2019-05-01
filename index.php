<?php
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);


if(!empty($_GET['search'])){
    $innerhtml= $_GET['search']; 
}

else{
    $innerhtml = "";
}

// Alle resultaten
$alleResultaten = $conn->prepare("SELECT*FROM tl_picture WHERE text LIKE '%$innerhtml%' ORDER BY id DESC");
$alleResultaten->execute();
$countAll =$alleResultaten->rowCount();


//zichtbare resultaten
$statement = $conn->prepare("SELECT*FROM tl_picture WHERE text LIKE '%$innerhtml%' ORDER BY id DESC  limit 20");
$statement->execute();
$collection = $statement->fetchAll();
$count =$statement->rowCount();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inspiration Hunter</title>
</head>
<body>
<h1>Inspiration Hunter</h1>
    <?php include_once("nav.php"); 
    
    echo "<br>Founded results: ".$countAll."<br>";
    
    echo "viewable results: ". $count;
    ?>

    <div class="all-posts">

<!--indien er GEEN resultaten worden gevonden-->
<?php if($count==0): ?>
<p>Geen resultaten gevonden<p>
<?php endif; ?>

<!--indien er WEL resultaten worden gevonden-->
<?php if($count>=1): ?>
<?php foreach($collection as $c): ?>
<div class="post">
<a href="detail-img.php?id=<?php echo $c['id']; ?>"><img src="images/<?php echo $c['image']; ?>" alt="" height="200" width="200" style="object-fit: cover"></a>
<p><?php echo $c['text']; ?></p>
<br>
<?php date_default_timezone_set('Europe/Brussels');

// datum + tijd vandaag
$nu =date("Y-m-d")."Datum van vandaag<br>";
echo $nu;

//$nuDateTime =date("Y-m-d H:i:s ")."tijd nu<br>";
//echo $nuDateTime."<br>";


// datum gisteren
$yesterday =date('Y-m-d',strtotime("-1 days"));
echo $yesterday." gisteren<br>";

// datum + tijd van de upload
$uploadTime = $c['time'];

//echo $uploadTime." tijd upload<br>";
$uploadDate = date('Y-m-d',strtotime($uploadTime));
echo $uploadDate." tijd upload<br>";


//een uur geleden
$hourAgo =date('Y-m-d H:i',strtotime("-1 days"));
echo $hourAgo." uur geleden<br>";


// Is de post gisteren geplaatst? WERKT!
if($uploadDate==$yesterday){
    echo "gisteren gepost om: ". date('H:i',strtotime($uploadTime))."<br>";
}

//if($nu-$yesterday==00-00-01){
  //  echo "vandaag gepost om: ". date('H:i',strtotime($uploadTime))."<br>";
//}



//datum van vandaag is kleiner dan gisteren
/*if(date($c['time'])<date("F j Y g:i a")){
    echo "today";
}


if(date('d M',time($c['time']."-1 days"))<date('d M ', time($c['time']))){
    echo "today";
}

//kleinere datum dan vandaag
if(date('Y-m-d', time($c['time']))<date('Y-m-d')){
    echo "yesterday";
}
*/
//echo gisteren
//echo date('d M',strtotime($c['time']."-1 days"));
//echo date("F j, Y, g:i a");?>
<div><a href="#" class="like">Like</a> <span class='likes'>xxx</span> people like this </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

</div>

<?php
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);


if(!empty($_GET['search'])){
    $innerhtml= $_GET['search']; 
}

else{
    $innerhtml = "";
}


?>

</body>
</html>
