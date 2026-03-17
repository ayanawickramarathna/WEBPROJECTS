<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: courses.php");
    exit;
}

$id = $_GET['id'];

/* Fetch existing course */
$result = mysqli_query($conn, "SELECT * FROM courses WHERE course_id='$id'");
$course = mysqli_fetch_assoc($result);

if (!$course) {
    header("Location: courses.php");
    exit;
}

$message = "";
$messageColor = "green";

/* Update course */
if (isset($_POST['update'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $mode = trim($_POST['mode']);
    $duration = trim($_POST['duration']);
    $fee = trim($_POST['fee']);

    if ($title && $category && $mode && $duration && $fee) {

        /* Image update (optional) */
        if (!empty($_FILES['image']['name'])) {
            $imageName = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];
            move_uploaded_file($tmpName, "images/" . $imageName);

            $sql = "UPDATE courses SET
                    title='$title',
                    category='$category',
                    mode='$mode',
                    duration='$duration',
                    fee='$fee',
                    image='$imageName'
                    WHERE course_id='$id'";
        } else {
            $sql = "UPDATE courses SET
                    title='$title',
                    category='$category',
                    mode='$mode',
                    duration='$duration',
                    fee='$fee'
                    WHERE course_id='$id'";
        }

        if (mysqli_query($conn, $sql)) {
            $message = "Course updated successfully.";
        } else {
            $message = "Error updating course.";
            $messageColor = "red";
        }
    } else {
        $message = "All fields are required.";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-course-container">
    <h2>Edit Course</h2>

    <?php if ($message != "") { ?>
        <p class="msg" style="color:<?php echo $messageColor; ?>">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <form method="post" enctype="multipart/form-data">

        <label>Course Title</label>
        <input type="text" name="title" value="<?php echo $course['title']; ?>" required>

        <label>Category</label>
        <input type="text" name="category" value="<?php echo $course['category']; ?>" required>

        <label>Mode</label>
        <select name="mode" required>
            <option <?php if($course['mode']=="Online") echo "selected"; ?>>Online</option>
            <option <?php if($course['mode']=="On-site") echo "selected"; ?>>On-site</option>
            <option <?php if($course['mode']=="Hybrid") echo "selected"; ?>>Hybrid</option>
        </select>

        <label>Duration</label>
        <input type="text" name="duration" value="<?php echo $course['duration']; ?>" required>

        <label>Fee (LKR)</label>
        <input type="number" name="fee" value="<?php echo $course['fee']; ?>" required>

        <label>Change Image (optional)</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" name="update">Update Course</button>
    </form>

    <p style="text-align:center;margin-top:20px;">
        <a href="courses.php">⬅ Back to Courses</a>
    </p>
</div>

</body>
</html>
