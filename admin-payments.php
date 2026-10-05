<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

include "db.php";

$sql = "SELECT * FROM payments ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Payments - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>StyleHub - Payments</h1>

<nav>

    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admin-customers.php">Customers</a>
    <a href="admin-orders.php">Orders</a>
    <a href="admin-logout.php">Logout</a>

</nav>

<h2>Payment Records</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Payment ID</th>
    <th>Order ID</th>
    <th>Payment Reference</th>
    <th>Payment Method</th>
    <th>Amount</th>
    <th>Payment Status</th>
    <th>Date</th>
</tr>

<?php

if ($result->num_rows > 0) {

    while ($payment = $result->fetch_assoc()) {

?>

<tr>

    <td><?php echo $payment['id']; ?></td>

    <td><?php echo $payment['order_id']; ?></td>

    <td>
        <?php echo htmlspecialchars($payment['payment_id'] ?? ''); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($payment['payment_method']); ?>
    </td>

    <td>
        &#8377;<?php echo $payment['amount']; ?>
    </td>

    <td>
        <?php echo htmlspecialchars($payment['payment_status']); ?>
    </td>

    <td>
        <?php echo $payment['created_at']; ?>
    </td>

</tr>

<?php

    }

} else {

    echo "<tr><td colspan='7'>No payment records found.</td></tr>";

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