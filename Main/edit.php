<?php
include 'db.php';

// Check if 'id' is set in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect to users page if 'id' is not set or is not a number
    header('Location: users.php?error=' . urlencode("Error: Invalid user ID."));
    exit();
}

$id = (int)$_GET['id']; // Cast to integer for safety
$errorMessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows === 0) {
    header('Location: users.php?error=' . urlencode("Error: User not found."));
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../SubStyle/edit.css">
    <link rel="stylesheet" href="../SubStyle/cursor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
<div class="circle"></div>

<div class="Cover">
    <p>Edit Profile</p>

    <div class="headertag">
        <i class="fa-brands fa-php" style="color: #74C0FC;"></i>
        <p style="color: #ffffff; margin: 10px 13px 0 0; font-size: 13px">edit.php</p>
    </div>

    <div class="back">
        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
        <a href="../Main/users.php" class="Regbtn">View Users</a>
    </div>
    
    <div class="Regist">
        <div class="active"></div>

        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="text" name="lname" value="<?php echo htmlspecialchars($user['lname']); ?>" required>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($user['fname']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
            <input type="submit" value="Update">
        </form>

        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

    </div>
</div>

<script src="../SubScript/cursor.js"></script>
<script src="../SubScript/errorHandling.js"></script>

</body>
</html>
