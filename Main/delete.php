<?php
include 'db.php';

$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: register.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
