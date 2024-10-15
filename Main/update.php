<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $lname = $conn->real_escape_string($_POST['lname']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    if ($password) {
        $sql = "UPDATE users SET lname='$lname', fname='$fname', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET lname='$lname', fname='$fname', email='$email' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: register.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
