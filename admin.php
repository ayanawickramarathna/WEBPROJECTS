<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch counts
$courseCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses")
)['total'];

$inquiryCount = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM inquiries")
)['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-container">
    <h2>Admin Dashboard</h2>
    <p class="admin-welcome">Welcome, Administrator</p>

    <div class="admin-cards">

        <a href="add_course.php" class="admin-card">
            <h3>Add Course</h3>
            <p>Create and manage training programs</p>
        </a>

        <a href="courses.php" class="admin-card">
            <h3>View Courses</h3>
            <p>Total Courses: <strong><?php echo $courseCount; ?></strong></p>
        </a>

        <a href="view_inquiries.php" class="admin-card">
            <h3>View Inquiries</h3>
            <p>New Messages: <strong><?php echo $inquiryCount; ?></strong></p>
        </a>

        <a href="add_instructor.php" class="admin-card">
    <h3>Add Instructor</h3>
    <p>Create instructor accounts</p>
</a>

    <a href="assign_instructor.php" class="admin-card">
    <h3>Assign Instructor</h3>
    <p>Link instructors to courses</p>
</a>

<a href="view_assignments.php" class="admin-card">
    <h3>View Assignments</h3>
    <p>See instructor–course mapping</p>
</a>



        <a href="logout.php" class="admin-card logout-card">
            <h3>Logout</h3>
            <p>Securely exit admin panel</p>
        </a>

    </div>
</div>

</body>
</html>
