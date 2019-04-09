<?php
$host = "localhost";
$db_name = "test";
$username = "root";
$password = "";
 
try{
    $conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
}
 
catch(PDOException $exception){
    //to handle connection error
    echo "Connection error: " . $exception->getMessage();
}

// select the image 
$query = "select * from images WHERE id = 1"; 
$stmt = $conn->prepare( $query );
 
// bind the id of the image you want to select
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();
 
// to verify if a record is found
$num = $stmt->rowCount();
 
if( $num ){
    // if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // specify header with content type,
    // you can do header("Content-type: image/jpg"); for jpg,
    // header("Content-type: image/gif"); for gif, etc.
    header("Content-type: image/png");
    
    //display the image data
    print $row['data'];
    exit;
}else{
    //if no image found with the given id,
    //load/query your default image here
}


?>