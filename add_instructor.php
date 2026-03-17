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
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "instructor";

    $sql = "INSERT INTO users (name,email,password,role)
            VALUES ('$name','$email','$password','$role')";

    if (mysqli_query($conn, $sql)) {
        $message = "Instructor added successfully.";
    } else {
        $message = "Error adding instructor.";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Instructor | Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-course-container">
    <h2>Add Instructor</h2>

    <p class="msg" style="color:<?php echo $messageColor; ?>">
        <?php echo $message; ?>
    </p>

    <form method="post">
        <label>Instructor Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="add">Add Instructor</button>
    </form>

    <p style="text-align:center;margin-top:20px;">
        <a href="admin.php">⬅ Back to Admin Dashboard</a>
    </p>
</div>

</body>
</html>
