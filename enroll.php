<?php
session_start();
include 'db.php';

/* Only logged-in students */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit;
}

/* Check course ID */
if (!isset($_GET['id'])) {
    header("Location: courses.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$course_id = $_GET['id'];

/* Check if already enrolled */
$check = mysqli_query(
    $conn,
    "SELECT * FROM enrollments 
     WHERE user_id='$user_id' AND course_id='$course_id'"
);

if (mysqli_num_rows($check) == 0) {
    mysqli_query(
        $conn,
        "INSERT INTO enrollments (user_id, course_id)
         VALUES ('$user_id', '$course_id')"
    );
    $message = "You have successfully enrolled in the course.";
} else {
    $message = "You are already enrolled in this course.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrollment Status | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-course-container">
    <h2>Enrollment Status</h2>

    <p class="msg" style="text-align:center;">
        <?php echo $message; ?>
    </p>

    <p style="text-align:center;margin-top:20px;">
        <a href="courses.php">⬅ Back to Courses</a>
    </p>
</div>

</body>
</html>
