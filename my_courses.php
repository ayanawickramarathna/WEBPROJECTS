<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT courses.* 
     FROM courses
     JOIN enrollments 
     ON courses.course_id = enrollments.course_id
     WHERE enrollments.user_id = '$user_id'"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Courses | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="courses-container">
    <h2>My Enrolled Courses</h2>
    <p class="courses-subtitle">
        Courses you have successfully enrolled in
    </p>

    <table class="course-table">
        <tr>
            <th>Course Title</th>
            <th>Category</th>
            <th>Mode</th>
            <th>Duration</th>
            <th>Fee (LKR)</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['mode']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo number_format($row['fee']); ?></td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5" style="text-align:center;">
                    You have not enrolled in any courses yet.
                </td>
            </tr>
        <?php } ?>
    </table>

    <p style="text-align:center;margin-top:20px;">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </p>
</div>

</body>
</html>
