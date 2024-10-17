<?php
include 'db.php';


$errorMessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';


$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
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
