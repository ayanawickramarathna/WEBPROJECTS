<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "
    SELECT 
        users.name AS instructor_name,
        users.email AS instructor_email,
        courses.title AS course_title,
        courses.category,
        courses.mode
    FROM instructor_courses
    JOIN users ON instructor_courses.instructor_id = users.user_id
    JOIN courses ON instructor_courses.course_id = courses.course_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Course Assignments | Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="courses-container">
    <h2>Instructor – Course Assignments</h2>
    <p class="courses-subtitle">
        Overview of instructors assigned to training programs
    </p>

    <table class="course-table">
        <tr>
            <th>Instructor Name</th>
            <th>Email</th>
            <th>Course Title</th>
            <th>Category</th>
            <th>Mode</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['instructor_name']; ?></td>
            <td><?php echo $row['instructor_email']; ?></td>
            <td><?php echo $row['course_title']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['mode']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <p style="text-align:center;margin-top:20px;">
        <a href="admin.php">⬅ Back to Admin Dashboard</a>
    </p>
</div>

</body>
</html>
