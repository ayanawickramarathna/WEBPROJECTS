<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$instructors = mysqli_query($conn, "SELECT * FROM users WHERE role='instructor'");
$courses = mysqli_query($conn, "SELECT * FROM courses");

$message = "";

if (isset($_POST['assign'])) {
    $instructor = $_POST['instructor'];
    $course = $_POST['course'];

    mysqli_query($conn,
        "INSERT INTO instructor_courses (instructor_id, course_id)
         VALUES ('$instructor','$course')"
    );

    $message = "Instructor assigned to course successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Instructor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-course-container">
    <h2>Assign Instructor to Course</h2>

    <p class="msg"><?php echo $message; ?></p>

    <form method="post">
        <label>Select Instructor</label>
        <select name="instructor" required>
            <?php while($i = mysqli_fetch_assoc($instructors)) { ?>
                <option value="<?php echo $i['user_id']; ?>">
                    <?php echo $i['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Select Course</label>
        <select name="course" required>
            <?php while($c = mysqli_fetch_assoc($courses)) { ?>
                <option value="<?php echo $c['course_id']; ?>">
                    <?php echo $c['title']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" name="assign">Assign</button>
    </form>

    <p style="text-align:center;margin-top:20px;">
        <a href="admin.php">⬅ Back to Admin Dashboard</a>
    </p>
</div>

</body>
</html>
