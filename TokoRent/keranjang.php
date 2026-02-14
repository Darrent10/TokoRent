<?php
session_start();
include 'db.php';

// Ambil aksi dari URL
$act = isset($_GET['act']) ? $_GET['act'] : null;

// Tambah ke keranjang
if ($act == 'add') {
    $id = $_GET['id'];

    // Ambil data produk berdasarkan ID
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$id'");
    $p = mysqli_fetch_object($produk);

    if ($p) {
        // Jika keranjang belum ada, buat array baru
        if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = [];
        }

        // Tambahkan produk ke keranjang
        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id]['jumlah'] += 1; // Tambah jumlah jika sudah ada
        } else {
            $_SESSION['keranjang'][$id] = [
                'nama_produk' => $p->product_name,
                'harga' => $p->product_price,
                'jumlah' => 1,
                'gambar' => $p->product_image
            ];
        }

        echo "<script>alert('Produk berhasil ditambahkan ke keranjang!');window.location='keranjang.php';</script>";
    } else {
        echo "<script>alert('Produk tidak ditemukan!');window.location='produk.php';</script>";
    }
}

// Tampilkan halaman keranjang
if ($act == null) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Keranjang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<header>
		<div class="container">
			<h1><a href="index.php">TokoRent</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
			</ul>
		</div>
	</header>
    
    <div class="section">
        <div class="container">
            <h3>Keranjang</h3>
            <div class="box">
                <?php if (!empty($_SESSION['keranjang'])): ?>
                    <table border="1" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            foreach ($_SESSION['keranjang'] as $id => $item):
                                $subtotal = $item['harga'] * $item['jumlah'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><img src="produk/<?php echo $item['gambar']; ?>" width="50"></td>
                                <td><?php echo $item['nama_produk']; ?></td>
                                <td>Rp. <?php echo number_format($item['harga']); ?></td>
                                <td>
                                    <form method="post" action="keranjang.php?act=update&id=<?php echo $id; ?>" style="display: inline;">
                                        <input type="number" name="jumlah" value="<?php echo $item['jumlah']; ?>" min="1" style="width: 50px;" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td>Rp. <?php echo number_format($subtotal); ?></td>
                                <td>
                                    <a href="keranjang.php?act=remove&id=<?php echo $id; ?>" onclick="return confirm('Yakin hapus produk ini?')" class="btn delete">Hapus</a>
                                    
                            <a href="checkout.php?id=<?php echo $id; ?>" class="btn">Checkout</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" align="right"><strong>Total</strong></td>
                                <td colspan="2"><strong>Rp. <?php echo number_format($total); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="produk.php" class="btn">Lanjutkan ke produk</a>
                <?php else: ?>
                    <p>Keranjang kosong.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}

// Hapus produk dari keranjang
if ($act == 'remove') {
    $id = $_GET['id'];
    unset($_SESSION['keranjang'][$id]);
    echo "<script>alert('Produk berhasil dihapus dari keranjang!');window.location='keranjang.php';</script>";
}

// Update jumlah produk di keranjang
if ($act == 'update') {
    $id = $_GET['id'];
    $new_quantity = (int)$_POST['jumlah'];
    if (isset($_SESSION['keranjang'][$id])) {
        if ($new_quantity > 0) {
            $_SESSION['keranjang'][$id]['jumlah'] = $new_quantity;
        } else {
            unset($_SESSION['keranjang'][$id]);
        }
    }
    echo "<script>window.location='keranjang.php';</script>";
}
?>