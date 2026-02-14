<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
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
            <h1><a href="dashboard.php">RentMarket</a></h1>
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="data-kategori.php"><i class="fas fa-tags"></i> Data Kategori</a></li>
                <li><a href="data-produk.php"><i class="fas fa-box"></i> Data Produk</a></li>
                <li><a href="data-pembelian.php"><i class="fas fa-shopping-cart"></i> Data Pembelian</a></li>
                <li><a href="keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Nama Pembeli</th>
                            <th>Alamat</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $purchase = mysqli_query($conn, "SELECT tb_purchase.*, tb_product.product_name as product_name FROM tb_purchase LEFT JOIN tb_product USING (product_id) ORDER BY purchase_id DESC");
                        if (mysqli_num_rows($purchase) > 0) {
                            while ($row = mysqli_fetch_array($purchase)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td>Rp. <?php echo number_format($row['purchase_price']) ?></td>
                                    <td><?php echo $row['purchase_quantity'] ?></td>
                                    <td><?php echo $row['purchase_name'] ?></td>
                                    <td><?php echo $row['purchase_address'] ?></td>
                                    <td><?php echo $row['purchase_method'] ?></td>
                                    <td><?php echo $row['purchase_date'] ?></td>
                                    <td><?php echo ($row['purchase_status'] == 0) ? 'Belum Dikirim' : (($row['purchase_status'] == 1) ? 'Dalam pengiriman' : ''); ?></td>
                                    <td>
                                         <button class="btn" onclick="window.location.href='edit-pembelian.php?id=<?php echo $row['purchase_id'] ?>'">Edit</button> <button class="btn delete" onclick="if(confirm('Yakin ingin hapus ?')) window.location.href='proses-hapus.php?id_purchase=<?php echo $row['purchase_id'] ?>'">Hapus</button>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="10">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
 	 <p>&copy; 2026 TokoRent. All rights reserved.</p>
	</footer>
</body>

</html>