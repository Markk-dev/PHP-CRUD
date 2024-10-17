<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        
        $user = $result->fetch_assoc();
        
        
        if (password_verify($password, $user['password'])) {
            
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['fname'] = $user['fname'];

            
            header('Location: dashboard.php');
            exit();
        } else {
            
            header('Location: login.php?error=' . urlencode("Invalid password. Please try again."));
            exit();
        }
    } else {
        
        header('Location: login.php?error=' . urlencode("No account found with that email address."));
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../SubStyle/cursor.css">
    <link rel="stylesheet" href="../SubStyle/login.css">

</head>
<body>
    <div class="circle"></div>

<div class="Cover">

    <div class="headertag">
        <i class="fa-brands fa-php" style="color: #74C0FC;"></i>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <div class="Regist"> 
        <div class="active"></div>

            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

                <form action="login.php" method="POST">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br>

                    <input type="submit" value="Login">
                </form>
    </div>
</div>
    <script src="../SubScript/cursor.js"></script>
</body>
</html>
