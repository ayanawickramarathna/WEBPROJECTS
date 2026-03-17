<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM inquiries ORDER BY inquiry_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Inquiries | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="courses-container">
    <h2>Student Inquiries</h2>
    <p class="courses-subtitle">
        Messages received from students and visitors
    </p>

    <table class="course-table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo nl2br($row['message']); ?></td>
        </tr>
        <?php } ?>
    </table>

    <p style="text-align:center;margin-top:20px;">
        <a href="admin.php">⬅ Back to Admin Dashboard</a>
    </p>
</div>

</body>
</html>
