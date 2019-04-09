<?php
$conn = new PDO("mysql:host=localhost;dbname=inspiration_hunter","root","root",null);
$result = $conn->query("SELECT * FROM tl_picture");
    
    if(!empty($result)){
        $imgData = $result->fetchAll();
        
        //Render image
        header("Content-type: image/jpg"); 
        echo $imgData['image']; 
    }else{
        echo 'Image not found...';
    }
?>