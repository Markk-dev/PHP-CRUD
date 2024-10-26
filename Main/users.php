<?php
session_start(); 
include 'db.php'; 

if (!isset($_SESSION['user_id']) || $_SESSION['state'] !== 'logged_in') {

    
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../SubStyle/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../SubStyle/cursor.css">
</head>
<body>

<div class="circle"></div>

<div class="Cover">
    <p>Registered Users</p>

    <div class="headertag">
        <i class="fa-brands fa-php" style="color: #74C0FC;"></i>
        <p style="color: #ffffff; margin: 12px 0 0 0;">users.php</p>
    </div>

    <div class="back">
        <i class="fa-solid fa-user" style="color: #ffffff;"></i>
        <a href='../Main/endsession.php' class="Regbtn">Log out</a>
    </div>
  
    <div class="Regist">
        <div class="active"></div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM users"); 
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['lname']}</td>
                        <td>{$row['fname']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <div class='ActionCase'>
                               <div class='Editbtn'>
                                    <a href='edit.php?id={$row['id']}' class='LinkEdit'>Edit</a>
                                </div>
                                <div class='Delbtn'>
                                    <a href='delete.php?id={$row['id']}' class='LinkDel' onclick='return confirmDelete();'>Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
            ?>
        </table>
        
    </div>
</div>

<script src="../SubScript/cursor.js"></script>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
}
</script>

</body>
</html>
