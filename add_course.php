<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$message = "";
$messageColor = "green";

if (isset($_POST['add'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $mode = trim($_POST['mode']);
    $duration = trim($_POST['duration']);
    $fee = trim($_POST['fee']);

    // Image handling
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $targetPath = "images/" . $imageName;

    if ($title && $category && $mode && $duration && $fee && $imageName) {

        if (move_uploaded_file($tmpName, $targetPath)) {

            $sql = "INSERT INTO courses (title, category, mode, duration, fee, image)
                    VALUES ('$title', '$category', '$mode', '$duration', '$fee', '$imageName')";

            if (mysqli_query($conn, $sql)) {
                $message = "Course added successfully with image.";
            } else {
                $message = "Database error while adding course.";
                $messageColor = "red";
            }

        } else {
            $message = "Image upload failed.";
            $messageColor = "red";
        }

    } else {
        $message = "All fields including image are required.";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-course-container">
    <h2>Add New Course</h2>

    <?php if ($message != "") { ?>
        <p class="msg" style="color:<?php echo $messageColor; ?>">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <!-- IMPORTANT: enctype -->
    <form method="post" enctype="multipart/form-data">

        <label>Course Title</label>
        <input type="text" name="title" required>

        <label>Category</label>
        <input type="text" name="category" required>

        <label>Mode</label>
        <select name="mode" required>
            <option value="">Select Mode</option>
            <option>Online</option>
            <option>On-site</option>
            <option>Hybrid</option>
        </select>

        <label>Duration</label>
        <input type="text" name="duration" required>

        <label>Fee (LKR)</label>
        <input type="number" name="fee" required>

        <label>Course Image</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="add">Add Course</button>
    </form>

    <p style="text-align:center;margin-top:20px;">
        <a href="admin.php">⬅ Back to Admin Dashboard</a>
    </p>
</div>

</body>
</html>
