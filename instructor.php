<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'instructor') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Panel | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard-container">
    <h2>Instructor Dashboard</h2>
    <p class="dashboard-subtitle">
        Welcome Instructor. Access your teaching-related information below.
    </p>

    <div class="dashboard-cards">

        <!-- VIEW COURSES -->
        <a href="instructor_courses.php" class="dashboard-card">
            <h3>Assigned Courses</h3>
            <p>View courses assigned to you</p>
        </a>

        <!-- VIEW INQUIRIES -->
        <a href="view_inquiries.php" class="dashboard-card">
            <h3>Student Inquiries</h3>
            <p>Review student questions</p>
        </a>

        <!-- LOGOUT -->
        <a href="logout.php" class="dashboard-card logout-card">
            <h3>Logout</h3>
            <p>Securely exit instructor panel</p>
        </a>

    </div>
</div>

</body>
</html>
