<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    // All Fields Required
    if (empty($_POST['lname']) || empty($_POST['fname']) || empty($_POST['email'])) {
        header('Location: edit.php?id=' . $_POST['id'] . '&error=' . urlencode("Error: All fields are required except password."));
        exit();
    }

    // Email Validation
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@gmail.com')) {
        header('Location: edit.php?id=' . $_POST['id'] . '&error=' . urlencode("Error: Please enter a valid Gmail address."));
        exit();
    }

    // Lname Fname Validation (allow letters and spaces)
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $lname) || !preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        header('Location: edit.php?id=' . $_POST['id'] . '&error=' . urlencode("Error: Names must only contain letters and spaces."));
        exit();
    }

    // Proceed with updating the user
    $id = $_POST['id'];
    $lname = $conn->real_escape_string($_POST['lname']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    try {
        $checkUserSql = "SELECT * FROM users WHERE email = ? AND id != ?";
        $stmt = $conn->prepare($checkUserSql);
        $stmt->bind_param('si', $email, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Error: A user with the same email already exists.");
        } else {
            $updateSql = "UPDATE users SET lname = ?, fname = ?, email = ?" . ($password ? ", password = ?" : "") . " WHERE id = ?";
            $stmt = $conn->prepare($updateSql);

            if ($password) {
                $stmt->bind_param('ssssi', $lname, $fname, $email, $password, $id);
            } else {
                $stmt->bind_param('sssi', $lname, $fname, $email, $id);
            }

            if ($stmt->execute()) {
                header('Location: users.php');
                exit();
            } else {
                throw new Exception("Error: Unable to update user. Please try again.");
            }
        }
    } catch (Exception $e) {
        header('Location: edit.php?id=' . $id . '&error=' . urlencode($e->getMessage()));
        exit();
    }
}

$conn->close();
?>
