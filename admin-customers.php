<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

include "db.php";

$sql = "SELECT id, fullname, email, mobile, created_at FROM users ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Customers - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>StyleHub - Customers</h1>

<nav>

    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admin-orders.php">Orders</a>
    <a href="admin-payments.php">Payments</a>
    <a href="admin-logout.php">Logout</a>

</nav>

<h2>Registered Customers</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Registration Date</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($customer = $result->fetch_assoc()) {

?>

<tr>

    <td><?php echo $customer['id']; ?></td>

    <td>
        <?php echo htmlspecialchars($customer['fullname']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($customer['email']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($customer['mobile']); ?>
    </td>

    <td>
        <?php echo $customer['created_at']; ?>
    </td>

</tr>

<?php

    }

} else {

    echo "<tr><td colspan='5'>No customers found.</td></tr>";

}

?>

</table>

<br>

<a href="admin-dashboard.php">
    <button>Back to Dashboard</button>
</a>

<footer>

    © 2026 StyleHub. All Rights Reserved.

</footer>

</body>

</html>