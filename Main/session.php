<?php
session_start(); 

include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, lname, fname, password FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['fname'] = $user['fname'];

            header('Location: users.php');
            exit();
        } else {
            
            header('Location: login.php?error=' . urlencode("Invalid password. Please try again."));
            exit();
        }
    } else {
        
        header('Location: login.php?error=' . urlencode("No account found with that email address."));
        exit();
    }

    $stmt->close(); 
}

$conn->close(); 
?>
