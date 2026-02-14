<?php
session_start();
include 'db.php';

if (!isset($_SESSION['purchase'])) {
    header('Location: index.php');
    exit();
}

$purchase = $_SESSION['purchase'];
unset($_SESSION['purchase']); // Clear after displaying
?>
<!DOCTYPE html>
<html>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background: #f4f6f8;
        color: #333;
    }

    header {
        background: #1e3a8a;
        padding: 15px 0;
    }

    header h1 a {
        color: #fff;
        text-decoration: none;
    }

    header ul {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    header ul li a {
        color: #fff;
        text-decoration: none;
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: auto;
    }

    .section {
        padding: 40px 0;
    }

    .receipt-container {
        max-width: 700px;
        margin: auto;
    }

    .receipt-header {
        text-align: center;
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: #fff;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .receipt-icon {
        font-size: 42px;
    }

    .receipt-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .receipt-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .detail-row {
        background: #f1f5f9;
        padding: 12px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        background: #f3f4f6;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .receipt-summary {
        border-top: 2px dashed #cbd5e1;
        padding-top: 15px;
        margin-top: 15px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .summary-row.total {
        font-size: 18px;
        font-weight: bold;
        color: #1e3a8a;
    }

    .receipt-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-print,
    .btn-home,
    .btn-cancel {
        padding: 12px 18px;
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-print { background: #2563eb; }
    .btn-home { background: #16a34a; }
    .btn-cancel { background: #dc2626; }

    @media print {
        header,
        .receipt-actions {
            display: none;
        }
    }
    </style>
<head>
    <meta charset="utf-8">
    <title>Struk Pembelian</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">TokoRent</a></h1>
            <ul>
                <li><a href="produk.php"><i class="fas fa-box"></i> Produk</a></li>
                <li><a href="keranjang.php"><i class="fas fa-shopping-cart"></i> Keranjang</a></li>
            </ul>
        </div>
    </header>

    <!-- struk -->
    <div class="section">
        <div class="container">
            <div class="receipt-container">
                <div class="receipt-header">
                    <div class="receipt-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2><i class="fas fa-receipt"></i> Struk Pembelian</h2>
                    <p>Terima kasih atas pembelian Anda!</p>
                </div>

                <div class="receipt-card">
                    <div class="receipt-details">
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-user"></i> Nama:</span>
                            <span class="value"><?php echo htmlspecialchars($purchase['name']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-map-marker-alt"></i> Alamat:</span>
                            <span class="value"><?php echo htmlspecialchars($purchase['address']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-truck"></i> Pengiriman:</span>
                            <span class="value"><?php echo htmlspecialchars($purchase['shipping_method']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-credit-card"></i> Pembayaran:</span>
                            <span class="value"><?php echo htmlspecialchars($purchase['payment_method']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-credit-card"></i> Nomer Telepon:</span>
                            <span class="value"><?php echo htmlspecialchars($purchase['phone']); ?></span>
                        </div>
                    </div>
                </div>

                <div class="receipt-card">
                    <h3><i class="fas fa-shopping-bag"></i> Detail Pesanan</h3>
                    <div class="order-items">
                        <?php foreach ($purchase['cart'] as $item) { ?>
                            <div class="order-item">
                                <div class="item-info">
                                    <span class="item-name"><?php echo htmlspecialchars($item['product_name']); ?></span>
                                    <span class="item-price">Rp. <?php echo number_format($item['product_price']); ?> x <?php echo $item['quantity']; ?></span>
                                </div>
                                <div class="item-total">Rp. <?php echo number_format($item['product_price'] * $item['quantity']); ?></div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="receipt-summary">
                        <?php if ($purchase['shipping_cost'] > 0) { ?>
                            <div class="summary-row">
                                <span>Biaya Pengiriman</span>
                                <span>Rp. <?php echo number_format($purchase['shipping_cost']); ?></span>
                            </div>
                        <?php } ?>
                        <div class="summary-row total">
                            <span><strong>Total Keseluruhan</strong></span>
                            <span><strong>Rp. <?php echo number_format($purchase['total']); ?></strong></span>
                        </div>
                    </div>
                </div>

                <div class="receipt-actions">
                    <button class="btn-print" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Struk
                    </button>
                    <a href="index.php" class="btn-home">
                        <i class="fas fa-home"></i> Kembali ke Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
