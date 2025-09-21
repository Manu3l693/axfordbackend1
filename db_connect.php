<?php

$host = 'localhost';
$dbname = 'axford';
$user = 'root';
$pass = '';

try {

    $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = json_decode(file_get_contents("php://input"), true);
    // echo 'Connection Successful';
    
} catch (PDOException $err) {
    echo 'Connection Failed: ' . $err->getMessage();
}






?>