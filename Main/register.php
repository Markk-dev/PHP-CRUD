<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to users page if already logged in
    header('Location: users.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../SubStyle/register.css">
    <link rel="stylesheet" href="../SubStyle/cursor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="circle"></div>

<div class="Cover">
    <p>Registration</p>

    <div class="headertag">
        <i class="fa-brands fa-php" style="color: #74C0FC;"></i>
        <p style="color: #ffffff; margin: 12px 13px 0 0; font-size: 12px">register.php</p>
    </div>

    <div class="back">
        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
        <a href="../Main/Login.php" class="Regbtn" style="font-size: .8rem;">Already Registered?</a>
    </div>

    <div class="Regist">
        <div class="active"></div>

        <form action="store.php" method="POST"> 
            <input type="text" name="lname" placeholder="Last Name" required>
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>
            <input type="submit" value="Register">
        </form>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
    </div>
</div>

<script src="../SubScript/cursor.js"></script>
<script src="../SubScript/errorHandling.js"></script>

</body>
</html>
