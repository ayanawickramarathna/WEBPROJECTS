<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="dashboard-container">
    <h2>Student Dashboard</h2>
    <p class="dashboard-subtitle">
        Welcome to SkillPro Institute. Manage your learning activities here.
    </p>


    <div class="dashboard-cards">

        <a href="my_courses.php" class="dashboard-card">
            <h3>My Courses</h3>
            <p>View courses you have enrolled in</p>
        </a>


        <a href="courses.php" class="dashboard-card">
            <h3>Browse Courses</h3>
            <p>Explore available training programs</p>
        </a>

        
        <a href="inquiry.php" class="dashboard-card">
            <h3>Send Inquiry</h3>
            <p>Contact SkillPro for more information</p>
        </a>

        <a href="logout.php" class="dashboard-card logout-card">
            <h3>Logout</h3>
            <p>Securely sign out from the system</p>
        </a>

    </div>
</div>

</body>
</html>
