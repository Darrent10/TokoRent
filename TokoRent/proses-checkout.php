<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header('Location: keranjang.php');
    exit();
}

if (isset($_POST['checkout'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $shipping_method = $_POST['shipping_method'];
    $payment_method = $_POST['payment_method'];

    // Update quantities in cart if provided
    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        $quantities = $_POST['quantity'];
        foreach ($quantities as $key => $qty) {
            $qty = intval($qty);
            if ($qty < 1) {
                $qty = 1; // Minimum quantity is 1
            }
            if (isset($_SESSION['cart'][$key])) {
                $_SESSION['cart'][$key]['quantity'] = $qty;
            }
        }
    }

    // Define shipping costs
    $shipping_costs = [
        'JNE' => 20000,
        'J&T' => 25000,
        'Lion Parcel' => 30000
    ];

    $shipping_cost = isset($shipping_costs[$shipping_method]) ? $shipping_costs[$shipping_method] : 0;

    // Calculate total
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['product_price'] * $item['quantity'];
    }
    $total += $shipping_cost;

    // Generate unique order_id
    $order_id = 'ORD' . time() . rand(100, 999);

    // Insert each item into tb_purchase
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['product_id'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];

        // Get product name from database to ensure accuracy
        $produk = mysqli_query($conn, "SELECT product_name FROM tb_product WHERE product_id = '$product_id'");
        $p = mysqli_fetch_object($produk);
        $product_name = $p->product_name;

        $query = "INSERT INTO tb_purchase (order_id, product_id, product_name, purchase_name, purchase_price, purchase_quantity, purchase_address, purchase_method, purchase_date, purchase_status) VALUES ('$order_id', '$product_id', '$product_name', '$name', '$product_price', '$quantity', '$address', '$payment_method', NOW(), 0)";
        mysqli_query($conn, $query);
    }

    // Store purchase details in session for struk.php
    $_SESSION['purchase'] = [
        'order_id' => $order_id,
        'cart' => $_SESSION['cart'],
        'total' => $total,
        'shipping_cost' => $shipping_cost,
        'shipping_method' => $shipping_method,
        'payment_method' => $payment_method,
        'name' => $name,
        'address' => $address,
        'phone' => $_POST['phone']
    ];

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to struk.php
    header('Location: struk.php');
    exit();
} else {
    header('Location: checkout.php');
    exit();
}
