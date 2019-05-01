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
$vandaag =date("Y-m-d");

$vandaagDateTime =date("Y-m-d H:i:s ");

//net gepost
$nuTime= date("H:i:s", strtotime("-1 sec"));

// datum gisteren
$yesterday =date('Y-m-d',strtotime("-1 days"));

// vanaf meer dan 1 dag geleden
$eergisteren =date('Y-m-d',strtotime("-2 days"));

// datum + tijd van de upload
$uploadTime = date('H:i',strtotime($c['time']));

// datum van de upload
$uploadDate = date('Y-m-d',strtotime($c['time']));

//half uur geleden
$halfHourAgo =date('H:i',strtotime("-30 min"));

//15 min geleden
$quarterAgo =date('H:i',strtotime("-15 min"));

//een uur geleden
$hourAgo =date('H:i',strtotime("-1 hour"));

//2 uur geleden
$twoHoursAgo =date('H:i',strtotime("-2 hour"));

// Is de post gisteren geplaatst?
if($uploadDate==$yesterday){
    echo "gisteren gepost om: ". date('H:i',strtotime($uploadTime))."<br>";
}

//eergisteren gepost?
if($uploadDate<=$eergisteren){
    echo "staat langer dan 2 dagen online";
}

// ---------indien vandaag gepost: meerdere opties van mededelingen ----------
switch($uploadDate==$vandaag){

//meer dan twee uur geleden gepost
case($uploadTime<$twoHoursAgo):
    echo"vandaag".date('H:i',strtotime($uploadTime));
break;

//meer dan een uur geleden gepost
case($uploadTime<$hourAgo):
    echo"1 uur geleden";
break;

//meer dan een half uur geleden
case($uploadTime<$halfHourAgo):
    echo "meer dan een half uur geleden";
break;

//minder dan een kwartier
case($uploadTime<$nuTime):
    echo "zonet";


//



}


?>
<div>
<a href="#" class="like">Like</a><span class='likes'>xxx</span> people like this </div>

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
