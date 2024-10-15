<?php

$host = 'localhost';
$db = 'testsub';
$username = 'root';
$password = '';

$conn = new mysqli( $host, $username, $password, $db);
    
if($conn->connect_error){
    die('Connection failed: '.$conn->connect_error);
}

?>