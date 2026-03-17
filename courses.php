<?php
session_start();
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courses | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="courses-container">
    <h2>Available Training Programs</h2>
    <p class="courses-subtitle">
        Browse our vocational courses designed to build practical, job-ready skills.
    </p>

    <table class="course-table">
        <tr>
            <th>Course</th>
            <th>Details</th>
            <th>Duration</th>
            <th>Fee (LKR)</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>

            <!-- COURSE COLUMN -->
            <td class="course-main">
                <?php if (!empty($row['image'])) { ?>
                    <img src="images/<?php echo $row['image']; ?>" class="course-img">
                <?php } else { ?>
                    <img src="images/default.png" class="course-img">
                <?php } ?>

                <div>
                    <strong><?php echo $row['title']; ?></strong><br>
                    <span class="badge category"><?php echo $row['category']; ?></span>
                    <span class="badge mode"><?php echo $row['mode']; ?></span>
                </div>
            </td>

            <!-- DETAILS -->
            <td>
                <ul class="course-details">
                    <li>Industry-focused training</li>
                    <li>Certification upon completion</li>
                    <li>Experienced instructors</li>
                </ul>
            </td>

            <td><?php echo $row['duration']; ?></td>

            <td><?php echo number_format($row['fee']); ?></td>

            <!-- ACTION -->
            <td>
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                ?>
                    <a class="edit-btn" href="edit_course.php?id=<?php echo $row['course_id']; ?>">
                        Edit
                    </a>
                <?php
                } elseif (isset($_SESSION['user_id'])) {
                ?>
                    <a class="enroll-btn" href="enroll.php?id=<?php echo $row['course_id']; ?>">
                        Enroll
                    </a>
                <?php
                } else {
                ?>
                    <a class="login-btn" href="login.php">Login to Enroll</a>
                <?php } ?>
            </td>

        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
