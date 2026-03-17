<?php
session_start();
include 'db.php';

$message = "";
$messageColor = "red";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role'] = $row['role'];

        // Role-based redirection
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } elseif ($row['role'] == 'instructor') {
            header("Location: instructor.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;
    } else {
        $message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>User Login</h2>

    <?php if ($message != "") { ?>
        <p class="msg" style="color:<?php echo $messageColor; ?>">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <form method="post">
        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p class="register-link">
        Don’t have an account? <a href="register.php">Register here</a>
    </p>
</div>

</body>
</html>
