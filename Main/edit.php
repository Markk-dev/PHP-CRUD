<?php
include 'db.php';

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
</head>
<body>
    <h2>Edit User</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="lname" value="<?php echo $user['lname']; ?>" required>
        <input type="text" name="fname" value="<?php echo $user['fname']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
        <input type="submit" value="Update">
    </form>
    <a href="users.php">Back</a>
</body>
</html>
