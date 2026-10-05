<?php

include "db.php";

$order_id = $_GET['order_id'] ?? 0;

if (!$order_id) {
    die("Invalid order ID.");
}

/* Create a test payment ID */
$payment_id = "TESTPAY" . time();

/* Update payment status */
$sql = "UPDATE payments
        SET payment_id = ?, payment_status = 'Success'
        WHERE order_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "si",
    $payment_id,
    $order_id
);

if ($stmt->execute()) {

header("Location: order-success.php?order_id=" . $order_id);
exit();

} else {

    echo "Payment update failed: " . $stmt->error;

}

?>