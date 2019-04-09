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
?>