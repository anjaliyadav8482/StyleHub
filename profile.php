<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile - StyleHub</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>StyleHub - My Profile</h1>

<nav>
    <a href="index.html">Home</a>
    <a href="women.html">Women</a>
    <a href="men.html">Men</a>
    <a href="beauty.html">Beauty</a>
    <a href="contact.html">Contact</a>
</nav>

<h2>My Profile</h2>

<p><strong>Name:</strong> <?php echo $_SESSION['fullname']; ?></p>

<p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>

<p>
    <a href="logout.php">Logout</a>
</p>

<footer>
&copy; 2026 StyleHub. All Rights Reserved.
</footer>

</body>
</html>