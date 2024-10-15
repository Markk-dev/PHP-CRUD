<?php
include 'db.php';

$id = $_GET['id'];


if (isset($id) && is_numeric($id)) {
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: users.php'); 
        exit(); 
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid ID parameter."; 
}

$conn->close();
?>
<a href="users.php">Back</a>
