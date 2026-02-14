<?php
session_start();
include 'db.php';

if (!isset($_SESSION['purchase'])) {
    header('Location: index.php');
    exit();
}

$purchase = $_SESSION['purchase'];

// Delete the purchases from the database
foreach ($purchase['cart'] as $item) {
    $product_id = $item['product_id'];
    $name = $purchase['name'];
    $address = $purchase['address'];
    $payment_method = $purchase['payment_method'];

    // Delete the specific purchase record
    $query = "DELETE FROM tb_purchase WHERE product_id = '$product_id' AND purchase_name = '$name' AND purchase_address = '$address' AND purchase_method = '$payment_method' ORDER BY purchase_date DESC LIMIT 1";
    mysqli_query($conn, $query);
}

// Clear the purchase session
unset($_SESSION['purchase']);

// Redirect to homepage
header('Location: index.php');
exit();
