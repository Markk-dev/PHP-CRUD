<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // All Fields Required
    if (empty($_POST['lname']) || empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm'])) {
        header('Location: register.php?error=' . urlencode("Error: All fields are required."));
        exit();
    }

    // Email Validation
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        header('Location: register.php?error=' . urlencode("Error: Please enter a valid Gmail address."));
        exit();
    }

    // Lname Fname Validation (allow letters and spaces)
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $lname) || !preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        header('Location: register.php?error=' . urlencode("Error: Names must only contain letters and spaces."));
        exit();
    }

    // Password Validation
    $password = $_POST['password'];
    if ($password !== $_POST['confirm']) {
        header('Location: register.php?error=' . urlencode("Error: Passwords do not match."));
        exit();
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[\W_]/', $password)) {
        header('Location: register.php?error=' . urlencode("Error: Password must be at least 8 characters long, contain at least one uppercase letter, and one special character."));
        exit();
    }

    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Escape strings for SQL
    $lname = $conn->real_escape_string($lname);
    $fname = $conn->real_escape_string($fname);
    $email = $conn->real_escape_string($email);

    // Check if user already exists
    $checkUserSql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkUserSql);
    if ($result->num_rows > 0) {
        header('Location: register.php?error=' . urlencode("Error: A user with this email already exists."));
        exit();
    }

    // Insert new user into the database
    $sql = "INSERT INTO users (lname, fname, email, password) VALUES ('$lname', '$fname', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header('Location: users.php');
        exit();
    } else {
        header('Location: register.php?error=' . urlencode("Error: Unable to register user. Please try again."));
        exit();
    }
}

$conn->close();
?>
