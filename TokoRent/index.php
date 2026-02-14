<?php 
    include 'db.php';
    session_start();
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TokoRent</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">TokoRent</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                <?php if (isset($_SESSION['pembeli_id'])): ?>
                    <li><a href="customers-edit.php">Halo, <?php echo $_SESSION['pembeli_nama']; ?></a></li>
                    <li><a href="customers-keluar.php">Logout</a></li>
                <?php else: ?>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- category -->
    <div class="section">
	<div class="container">
		<h3>Kategori</h3>
		<div class="box">
			<?php
			$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
			if(mysqli_num_rows($kategori) > 0){
				while($k = mysqli_fetch_array($kategori)){
			?>
				<a href="produk.php?kat=<?= $k['category_id'] ?>">
					<div class="col-5 kategori-box">
						<p><?= $k['category_name'] ?></p>
					</div>
				</a>
			<?php }} else { ?>
				<p>Kategori tidak ada</p>
			<?php } ?>
		</div>
	</div>
</div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>    
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
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
