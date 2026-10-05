<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>StyleHub Admin Dashboard</h1>

<nav>

    <a href="index.html">Home</a>
    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admin-logout.php">Logout</a>

</nav>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>

<p>Welcome to the StyleHub Administration Panel.</p>

<hr>

<h2>Admin Options</h2>

<p>
    <a href="admin-customers.php">
        <button>View Customers</button>
    </a>
</p>

<p>
    <a href="admin-orders.php">
        <button>View Orders</button>
    </a>
</p>

<p>
    <a href="admin-payments.php">
        <button>View Payments</button>
    </a>
</p>

<hr>

<p>
    From this dashboard, the administrator can manage
    customers, orders and payment information.
</p>

<footer>

    © 2026 StyleHub. All Rights Reserved.

</footer>

</body>

</html>