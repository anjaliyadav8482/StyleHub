<?php

session_start();
include "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $admin = $result->fetch_assoc();

        if ($password == $admin['password']) {

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];

            header("Location: admin-dashboard.php");
            exit();

        } else {

            $error = "Incorrect password.";

        }

    } else {

        $error = "Admin username not found.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Login - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>StyleHub Admin Login</h1>

<nav>

    <a href="index.html">Home</a>
    <a href="women.html">Women</a>
    <a href="men.html">Men</a>
    <a href="beauty.html">Beauty</a>

</nav>

<h2>Admin Login</h2>

<?php

if ($error != "") {
    echo "<p style='color:red;'>$error</p>";
}

?>

<form method="post">

    <input
        type="text"
        name="username"
        placeholder="Admin Username"
        required
    >

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Admin Password"
        required
    >

    <br><br>

    <button type="submit">Login</button>

</form>

<footer>

    © 2026 StyleHub. All Rights Reserved.

</footer>

</body>

</html>
