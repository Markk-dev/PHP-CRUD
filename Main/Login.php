<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https:
    <link rel="stylesheet" href="../SubStyle/cursor.css">
    <link rel="stylesheet" href="../SubStyle/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
    <div class="circle"></div>

    <div class="Cover">
        <p>Log in</p>


        <div class="headertag">
            <i class="fa-brands fa-php" style="color: #74C0FC;"></i>
            <p style="color: #ffffff; margin: 12px 13px 0 0; font-size: 12px">login.php</p>
        </div>

        <div class="back">
            <i class="fa-solid fa-user" style="color: #ffffff;"></i>
            <a href="register.php" class="Regbtn" style="color: #ffffff; margin: 0 13px 0 0; font-size: .8rem; text-decoration: none;">Register here?</a>
        </div>

      

        <div class="Regist"> 
            <div class="active"></div>
 
            <form action="session.php" method="POST">
                <input type="email" id="email" name="email" placeholder="Email" required><br>

                <input type="password" id="password" name="password" placeholder="Password" required><br>

                <input type="submit" value="Login">
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
