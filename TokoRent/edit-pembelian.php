<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$purchase = mysqli_query($conn, "SELECT * FROM tb_purchase WHERE purchase_id = '" . $_GET['id'] . "' ");
if (mysqli_num_rows($purchase) == 0) {
    echo '<script>window.location="data-pembelian.php"</script>';
}
$p = mysqli_fetch_object($purchase);
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
            <h1><a href="dashboard.php">TokoRent</a></h1>
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
            <h3>Edit Data Pembelian</h3>
            <div class="box">
                <form action="" method="POST">
                    <select class="input-control" name="status">
                        <option value="">--Pilih Status Pengiriman--</option>
                        <option value="0" <?php echo ($p->purchase_status == 0) ? 'selected' : ''; ?>>Belum Dikirim</option>
                        <option value="1" <?php echo ($p->purchase_status == 1) ? 'selected' : ''; ?>>Dalam Pengiriman</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $status = $_POST['status'];

                    // Validasi: Pastikan nama pembeli dan nama produk tidak sama
                    if ($p->purchase_name == $p->product_name) {
                        echo '<script>alert("Nama pembeli dan nama produk tidak boleh sama!")</script>';
                    } else {
                        $update = mysqli_query($conn, "UPDATE tb_purchase SET
                                                purchase_status = '" . $status . "'
                                                WHERE purchase_id = '" . $p->purchase_id . "' ");
                        if ($update) {
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="data-pembelian.php"</script>';
                        } else {
                            echo 'gagal ' . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
 	 <p>&copy; 2026 TokoRent. All rights reserved.</p>
	</footer>
</body>

</html>