<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'instructor') {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT courses.* FROM courses
     JOIN instructor_courses
     ON courses.course_id = instructor_courses.course_id
     WHERE instructor_courses.instructor_id = '$id'"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="courses-container">
    <h2>My Assigned Courses</h2>

    <table class="course-table">
        <tr>
            <th>Course</th>
            <th>Category</th>
            <th>Mode</th>
            <th>Duration</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['mode']; ?></td>
            <td><?php echo $row['duration']; ?></td>
        </tr>
        <?php } ?>
    </table>

    <p style="text-align:center;margin-top:20px;">
        <a href="instructor.php">⬅ Back</a>
    </p>
</div>

</body>
</html>
