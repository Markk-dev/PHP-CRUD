<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    $lname = $conn->real_escape_string($_POST['lname']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $checkUserSql = "SELECT * FROM users WHERE lname='$lname' AND fname='$fname' AND email='$email'";
    $result = $conn->query($checkUserSql);

    if ($result->num_rows > 0) {
        
        echo "Error: A same match in parameter is present.";
    } else {
        
        $sql = "INSERT INTO users (lname, fname, email, password) VALUES ('$lname', '$fname', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: users.php');
            exit();
        } else {
            
            echo "Error: Unable to register user. Please try again.";
            
            
        }
    }
}
$conn->close();
?>
