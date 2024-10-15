<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $lname = $conn->real_escape_string($_POST['lname']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO users (lname, fname, email, password) VALUES ('$lname', '$fname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header('Location: users.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
