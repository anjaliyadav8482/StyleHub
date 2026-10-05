<?php

mysqli_report(MYSQLI_REPORT_OFF);

include "db.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password != $confirm_password) {
    echo "Passwords do not match.";
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (fullname, email, mobile, password)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssss",
    $fullname,
    $email,
    $mobile,
    $hashed_password
);

if ($stmt->execute()) {

    header("Location: login.html");
    exit();

} else {

    if ($stmt->errno == 1062) {
        echo "This email is already registered. Please login.";
    } else {
        echo "Signup failed. Please try again.";
    }

}

?>