<?php
include 'db.php';

$message = "";
$messageColor = "green";

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "student";

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        $message = "Registration successful. You can now login.";
    } else {
        $message = "Email already exists.";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="register-container">
    <h2>Student Registration</h2>

    <?php if ($message != "") { ?>
        <p class="msg" style="color:<?php echo $messageColor; ?>">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <form method="post">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email Address</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p class="login-link">
        Already registered? <a href="login.php">Login here</a>
    </p>
</div>

</body>
</html>
