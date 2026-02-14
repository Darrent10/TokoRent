<?php 
    error_reporting(0);
    include 'db.php';

    // Ambil data kontak admin
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);

    // Ambil data produk berdasarkan ID
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Produk - TokoRent</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1><a href="index.php">TokoRent</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="section">
        <div class="container">
            <div class="product-box">
                <div class="product-image">
                    <img src="produk/<?php echo $p->product_image ?>" alt="<?php echo $p->product_name ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p><?php echo $p->product_description ?></p>
                    <p>
                        <a href="checkout.php?id=<?php echo $p->product_id ?>" class="btn">Beli Sekarang</a>
                        <a href="keranjang.php?act=add&id=<?php echo $p->product_id ?>" class="btn">Tambah ke Keranjang</a>
                    </p>
                    <p>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank" class="btn wa">Hubungi via WhatsApp</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
		<div class="container">
			<div class="footer-info">
				<div class="footer-section">
					<h4>Alamat</h4>
					<p><?php echo $a->admin_address ?></p>
				</div>
				<div class="footer-section">
					<h4>Email</h4>
					<p><?php echo $a->admin_email ?></p>
				</div>
    <div class="footer-section">
        <h4>No. Hp</h4>
        <p><?php echo $a->admin_telp ?></p>
    </div>
</div>
			<div class="footer-copyright">
				<small>Copyright &copy; 2026 - TokoRent.</small>
			</div>
		</div>
	</div>
</body>
</html>