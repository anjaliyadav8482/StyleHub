<?php

include "db.php";

$order_id = $_GET['order_id'] ?? 0;

if (!$order_id) {
    die("Order information not found.");
}

$sql = "SELECT * FROM orders WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $order_id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Order not found.");
}

$order = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Order Successful - StyleHub</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h1>Order Placed Successfully!</h1>

<p>Thank you for shopping with StyleHub.</p>

<hr>

<h2>Customer Information</h2>

<p>
    <strong>Customer Name:</strong>
    <?php echo htmlspecialchars($order['customer_name']); ?>
</p>

<p>
    <strong>Email:</strong>
    <?php echo htmlspecialchars($order['email']); ?>
</p>

<p>
    <strong>Mobile Number:</strong>
    <?php echo htmlspecialchars($order['mobile']); ?>
</p>

<p>
    <strong>Delivery Address:</strong>
    <?php echo htmlspecialchars($order['address']); ?>
</p>

<hr>

<h2>Order Information</h2>

<p>
    <strong>Order ID:</strong>
    <?php echo $order['id']; ?>
</p>

<p>
    <strong>Product:</strong>
    <?php echo htmlspecialchars($order['product_name']); ?>
</p>

<p>
    <strong>Quantity:</strong>
    <?php echo $order['quantity']; ?>
</p>

<p>
    <strong>Total Amount:</strong>
    &#8377;<?php echo $order['total_price']; ?>
</p>

<p>
    <strong>Payment Method:</strong>
    <?php echo htmlspecialchars($order['payment_method']); ?>
</p>

<hr>

<h2>Thank You!</h2>

<p>
    Your order has been received successfully.
</p>

<a href="index.html">
    <button>Continue Shopping</button>
</a>

<footer>

    © 2026 StyleHub. All Rights Reserved.

</footer>

</body>

</html>