<?php
session_start();
include 'db.php';

if (isset($_GET['idk'])) {
	$delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '" . $_GET['idk'] . "' ");
	echo '<script>window.location="data-kategori.php"</script>';
}

if (isset($_GET['idp'])) {
	$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
	$p = mysqli_fetch_object($produk);

	unlink('./produk/' . $p->product_image);

	$delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '" . $_GET['idp'] . "' ");
	echo '<script>window.location="data-produk.php"</script>';
}

if (isset($_GET['id_purchase'])) {
	$delete = mysqli_query($conn, "DELETE FROM tb_purchase WHERE purchase_id = '" . $_GET['id_purchase'] . "' ");
	echo '<script>window.location="data-pembelian.php"</script>';
}

if (isset($_GET['key'])) {
	$key = $_GET['key'];
	if (isset($_SESSION['cart'][$key])) {
		unset($_SESSION['cart'][$key]);
		// Reindex the array to avoid gaps
		$_SESSION['cart'] = array_values($_SESSION['cart']);
	}
	header('Location: keranjang.php');
	exit();
}
