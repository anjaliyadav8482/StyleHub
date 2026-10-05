<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

include "db.php";

/* Update order status */

if (isset($_POST['update_status'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sql = "UPDATE orders
            SET order_status = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "si",
        $order_status,
        $order_id
    );

    $stmt->execute();

    header("Location: admin-orders.php");
    exit();
}

/* Get all orders */

$sql = "SELECT * FROM orders ORDER BY id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Orders - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>StyleHub - Orders</h1>

<nav>

    <a href="admin-dashboard.php">Dashboard</a>
    <a href="admin-customers.php">Customers</a>
    <a href="admin-payments.php">Payments</a>
    <a href="admin-logout.php">Logout</a>

</nav>

<h2>All Orders</h2>

<table border="1" cellpadding="10">

<tr>

    <th>Order ID</th>
    <th>Customer Name</th>
    <th>Email</th>
    <th>Mobile</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Payment Method</th>
    <th>Order Status</th>
    <th>Update</th>

</tr>

<?php

if ($result->num_rows > 0) {

    while ($order = $result->fetch_assoc()) {

?>

<tr>

    <td>
        <?php echo $order['id']; ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['customer_name']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['email']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['mobile']); ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['product_name']); ?>
    </td>

    <td>
        <?php echo $order['quantity']; ?>
    </td>

    <td>
        &#8377;<?php echo $order['total_price']; ?>
    </td>

    <td>
        <?php echo htmlspecialchars($order['payment_method']); ?>
    </td>

    <td>

        <form method="post">

            <input
                type="hidden"
                name="order_id"
                value="<?php echo $order['id']; ?>"
            >

            <select name="order_status">

                <option value="Pending"
                    <?php
                    if ($order['order_status'] == 'Pending')
                        echo 'selected';
                    ?>>
                    Pending
                </option>

                <option value="Confirmed"
                    <?php
                    if ($order['order_status'] == 'Confirmed')
                        echo 'selected';
                    ?>>
                    Confirmed
                </option>

                <option value="Shipped"
                    <?php
                    if ($order['order_status'] == 'Shipped')
                        echo 'selected';
                    ?>>
                    Shipped
                </option>

                <option value="Delivered"
                    <?php
                    if ($order['order_status'] == 'Delivered')
                        echo 'selected';
                    ?>>
                    Delivered
                </option>

            </select>

    </td>

    <td>

            <button
                type="submit"
                name="update_status"
            >
                Update
            </button>

        </form>

    </td>

</tr>

<?php

    }

} else {

    echo "<tr><td colspan='10'>No orders found.</td></tr>";

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