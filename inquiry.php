<?php
include 'db.php';

$message = "";
$messageColor = "green";

if (isset($_POST['send'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $msg = trim($_POST['message']);

    if ($name != "" && $email != "" && $msg != "") {
        $sql = "INSERT INTO inquiries (name, email, message)
                VALUES ('$name', '$email', '$msg')";

        if (mysqli_query($conn, $sql)) {
            $message = "Your inquiry has been sent successfully.";
        } else {
            $message = "Something went wrong. Please try again.";
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
    <title>Contact Us | SkillPro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="inquiry-container">
    <h2>Contact SkillPro Institute</h2>

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

        <label>Your Message</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit" name="send">Send Inquiry</button>
    </form>
</div>

</body>
</html>
