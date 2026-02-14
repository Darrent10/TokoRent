<?php
session_start();
include 'db.php';

// Check if there's a product ID in URL (from detail-products.php or keranjang.php)
$product_id_from_url = isset($_GET['id']) ? $_GET['id'] : null;

// If cart is empty but there's a product ID in URL, fetch that product
if ((!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) && $product_id_from_url) {
    // Fetch product details
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$product_id_from_url'");
    $p = mysqli_fetch_object($produk);
    
    if ($p) {
        // Create a temporary cart item
        $_SESSION['keranjang'][$product_id_from_url] = [
            'nama_produk' => $p->product_name,
            'harga' => $p->product_price,
            'jumlah' => 1,
            'gambar' => $p->product_image
        ];
    } else {
        // Product not found, redirect to keranjang
        header('Location: keranjang.php');
        exit;
    }
}

// If cart is still empty (no product ID in URL), redirect to keranjang
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header('Location: keranjang.php');
    exit;
}

// Convert keranjang to cart format
$_SESSION['cart'] = [];
$total = 0;
foreach ($_SESSION['keranjang'] as $product_id => $item) {
    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'product_name' => $item['nama_produk'],
        'product_price' => $item['harga'],
        'quantity' => $item['jumlah']
    ];
    $total += $item['harga'] * $item['jumlah'];
}
?>
<!DOCTYPE html>
<html>
    <style>
body {
    background: #f4f7fb;
}

.checkout-header {
    background: linear-gradient(135deg, #1E3A8A, #3b5bcc);
    padding: 40px 0;
    color: #fff;
}

.checkout-header h1 {
    font-size: 28px;
}

.subtitle {
    opacity: 0.9;
}

.checkout-layout {
    display: flex;
    gap: 30px;
}

.box {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: none;
}

.order-summary h4,
.shipping-details h4,
.shipping-options h4,
.payment-options h4 {
    color: #1E3A8A;
}

.order-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.item-name {
    font-weight: 600;
}

.item-total {
    font-weight: bold;
    color: #1E3A8A;
}

.quantity-input {
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    width: 60px;
    text-align: center;
}

.option-btn {
    background: #f8fafc;
    border: 2px solid #e5e7eb;
    border-radius: 14px;
    padding: 15px;
}

.option-btn:hover {
    background: #e6f3ff;
    border-color: #1E3A8A;
}

.option-btn.selected {
    background: #e6f3ff;
    border-color: #1E3A8A;
    box-shadow: 0 0 0 3px rgba(30,58,138,0.2);
}

.btn-primary {
    background: linear-gradient(135deg, #1E3A8A, #3b5bcc);
    border-radius: 30px;
    padding: 14px 40px;
    font-size: 17px;
}

.btn-primary:hover {
    box-shadow: 0 8px 20px rgba(30,58,138,0.4);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .checkout-layout {
        flex-direction: column;
    }
}
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TokoRent</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<!-- checkout -->
    <div class="checkout-section">
        <div class="checkout-header">
            <div class="container">
                <div class="breadcrumb">
                    <a href="keranjang.php"><i class="fas fa-shopping-cart"></i> Keranjang</a>
                    <span class="separator">→</span>
                    <span class="active"><i class="fas fa-credit-card"></i> Checkout</span>
                </div>
                <h1><i class="fas fa-credit-card"></i> Selesaikan Pesanan Anda</h1>
                <p class="subtitle">Isi data pengiriman dan pilih metode pembayaran untuk menyelesaikan pembelian</p>
            </div>
        </div>
        <div class="container">
            <div class="checkout-layout">
                <div class="checkout-left">
                    <div class="box order-summary">
                        <div class="summary-header">
                            <h4><i class="fas fa-receipt"></i> Ringkasan Pesanan</h4>
                            <span class="item-count"><?php echo count($_SESSION['cart']); ?> item</span>
                        </div>
                        <div class="order-items">
                            <?php foreach ($_SESSION['cart'] as $item) { ?>
                                <div class="order-item">
                                    <div class="item-details">
                                        <span class="item-name"><?php echo $item['product_name'] ?></span>
                                        <span class="item-price">Rp. <?php echo number_format($item['product_price']) ?></span>
                                    </div>
                                    <div class="item-quantity">
                                        <input type="number" name="quantity[]" value="<?php echo $item['quantity'] ?>" min="1" class="quantity-input">
                                    </div>
                                    <div class="item-total">Rp. <?php echo number_format($item['product_price'] * $item['quantity']) ?></div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="order-total">
                            <div id="shipping-row" class="total-row" style="display: none;">
                                <span>Biaya Pengiriman</span>
                                <span id="shipping-cost">Rp. 0</span>
                            </div>
                            <div class="total-row grand-total">
                                <span><strong>Total Keseluruhan</strong></span>
                                <span id="grand-total"><strong>Rp. <?php echo number_format($total) ?></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-right">
                    <form action="proses-checkout.php" method="POST">
                        <div class="box shipping-details">
                            <h4><i class="fas fa-truck"></i> Detail Pengiriman</h4>
                            <input type="text" name="name" placeholder="Nama Pembeli" class="input-control" required>
                            <input type="text" name="address" placeholder="Alamat Lengkap" class="input-control" required>
                            <input type="text" name="phone" placeholder="Nomor Telepon" class="input-control" required>
                        </div>

                        <div class="box shipping-options">
                            <h4><i class="fas fa-shipping-fast"></i> Jasa Pengiriman</h4>
                            <div class="option-grid">
                                <button type="button" class="option-btn btn-shipping" data-value="JNE">
                                    <i class="fas fa-truck"></i>
                                    <span>JNE</span>
                                    <small>Rp. 20,000</small>
                                </button>
                                <button type="button" class="option-btn btn-shipping" data-value="J&T">
                                    <i class="fas fa-box"></i>
                                    <span>J&T</span>
                                    <small>Rp. 25,000</small>
                                </button>
                                <button type="button" class="option-btn btn-shipping" data-value="SiCepat">
                                    <i class="fas fa-shipping-fast"></i>
                                    <span>SiCepat</span>
                                    <small>Rp. 30,000</small>
                                </button>
                            </div>
                            <input type="hidden" name="shipping_method" id="shipping_method" required>
                        </div>

                        <div class="box payment-options">
                            <h4><i class="fas fa-credit-card"></i> Metode Pembayaran</h4>
                            <div class="option-grid">
                                <button type="button" class="option-btn btn-payment" data-value="Transfer Bank">
                                    <i class="fas fa-university"></i>
                                    <span>Transfer Bank</span>
                                </button>
                                <button type="button" class="option-btn btn-payment" data-value="COD">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <span>Cash on Delivery</span>
                                </button>
                                <button type="button" class="option-btn btn-payment" data-value="e-wallet">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span>E-wallet</span>
                                </button>
                            </div>
                            <input type="hidden" name="payment_method" id="payment_method" required>
                        </div>

                        <div class="checkout-actions">
                            <input type="submit" name="checkout" value="Pesan Sekarang" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
        // Function to format number as Rupiah
        function formatRupiah(number) {
            return 'Rp. ' + number.toLocaleString('id-ID');
        }

        // Function to update totals
        function updateTotals() {
            let total = 0;
            const orderItems = document.querySelectorAll('.order-item');

            orderItems.forEach(item => {
                const priceText = item.querySelector('.item-price').textContent;
                const quantityInput = item.querySelector('.quantity-input');
                const subtotalElement = item.querySelector('.item-total');

                const price = parseInt(priceText.replace(/[^\d]/g, ''));
                const quantity = parseInt(quantityInput.value) || 1;
                const subtotal = price * quantity;

                subtotalElement.textContent = formatRupiah(subtotal);
                total += subtotal;
            });

            // Add shipping cost if selected
            const shippingMethod = document.getElementById('shipping_method').value;
            let shippingCost = 0;
            if (shippingMethod) {
                const shippingCosts = {
                    'JNE': 20000,
                    'J&T': 25000,
                    'SiCepat': 30000
                };
                shippingCost = shippingCosts[shippingMethod] || 0;
            }

            const shippingRow = document.getElementById('shipping-row');
            const shippingCostElement = document.getElementById('shipping-cost');
            const grandTotalElement = document.getElementById('grand-total');

            if (shippingCost > 0) {
                shippingRow.style.display = 'flex';
                shippingCostElement.textContent = formatRupiah(shippingCost);
            } else {
                shippingRow.style.display = 'none';
                shippingCostElement.textContent = 'Rp. 0';
            }

            const grandTotal = total + shippingCost;
            grandTotalElement.innerHTML = '<strong>' + formatRupiah(grandTotal) + '</strong>';
        }

        // Function to handle button selection for payment methods
        document.querySelectorAll('.btn-payment').forEach(button => {
            button.addEventListener('click', function() {
                // Remove selected class from all buttons
                document.querySelectorAll('.btn-payment').forEach(btn => btn.classList.remove('selected'));
                // Add selected class to clicked button
                this.classList.add('selected');
                // Set the hidden input value
                document.getElementById('payment_method').value = this.getAttribute('data-value');
            });
        });

        // Function to handle button selection for shipping methods
        document.querySelectorAll('.btn-shipping').forEach(button => {
            button.addEventListener('click', function() {
                // Remove selected class from all buttons
                document.querySelectorAll('.btn-shipping').forEach(btn => btn.classList.remove('selected'));
                // Add selected class to clicked button
                this.classList.add('selected');
                // Set the hidden input value
                document.getElementById('shipping_method').value = this.getAttribute('data-value');
                // Update totals when shipping is selected
                updateTotals();
            });
        });

        // Add event listeners for quantity changes
        document.querySelectorAll('input[name="quantity[]"]').forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        // Initial calculation
        updateTotals();
    </script>
</body>
</html>
