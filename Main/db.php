<?php

$host = 'localhost';
$db = 'testdb';
$username = 'root';
$password = '';

$conn = new mysqli( $host, $username, $password, $db);
    
if($conn->connect_error){
    die('Connection failed: '.$conn->connect_error);
}

?>