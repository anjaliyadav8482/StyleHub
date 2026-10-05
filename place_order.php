<?php

include "db.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$payment = $_POST['payment'];

$product = $_POST['product'];
$quantity = $_POST['quantity'];
$total = $_POST['total'];


/* Insert order */

$sql = "INSERT INTO orders
(customer_name, email, mobile, address, product_name, quantity, total_price, payment_method)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssids",
    $fullname,
    $email,
    $mobile,
    $address,
    $product,
    $quantity,
    $total,
    $payment
);

if ($stmt->execute()) {

    /* Get newly created order ID */

    $order_id = $conn->insert_id;


    /* Payment status */

    if ($payment == "COD") {

        $payment_status = "Pending";

    } else {

        $payment_status = "Pending";

    }


    /* Insert payment record */

    $payment_id = NULL;

    $payment_sql = "INSERT INTO payments
    (order_id, payment_id, payment_method, amount, payment_status)
    VALUES (?, ?, ?, ?, ?)";

    $payment_stmt = $conn->prepare($payment_sql);

    $payment_stmt->bind_param(
        "issds",
        $order_id,
        $payment_id,
        $payment,
        $total,
        $payment_status
    );

    $payment_stmt->execute();


    /* Redirect */

    if ($payment == "COD") {

        header("Location: order-success.php?order_id=" . $order_id);
        exit();

    } else {

        header(
            "Location: online-payment.html?order_id=" .
            $order_id .
            "&amount=" .
            $total
        );

        exit();
    }

} else {

    echo "Order failed: " . $stmt->error;

}

?>