<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "daily_desk";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$myDB;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 

catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>