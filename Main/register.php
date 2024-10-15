<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href='./Sub/register.css'>
</head>
<body>
    <h2>Register</h2>
    <form action="store.php" method="POST"> 
        <input type="text" name="lname" placeholder="Last Name" required>
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Register">
    </form>

    <a href="../Main/users.php">View Registered Users</a>


</body>
</html>
