<?php
	session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
	include 'db.php';
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
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data Kategori</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="data-pembelian.php">Data Pembelian</a></li>
				<li><a href="keluar.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Dashboard</h3>
			<div class="dashboard-layout">
				<div class="box welcome-box">
					<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Toko Online</h4>
					<?php
						// Total Orders
						$query_total_orders = mysqli_query($conn, "SELECT COUNT(*) as total_orders FROM tb_purchase");
						$data_total_orders = mysqli_fetch_assoc($query_total_orders);
						$total_orders = $data_total_orders['total_orders'];

						// Total Income
						$query_total_income = mysqli_query($conn, "SELECT SUM(purchase_price * purchase_quantity) as total_income FROM tb_purchase");
						$data_total_income = mysqli_fetch_assoc($query_total_income);
						$total_income = $data_total_income['total_income'] ? $data_total_income['total_income'] : 0;

						// Completed Orders
						$query_completed_orders = mysqli_query($conn, "SELECT COUNT(*) as completed_orders FROM tb_purchase WHERE purchase_status = 1");
						$data_completed_orders = mysqli_fetch_assoc($query_completed_orders);
						$completed_orders = $data_completed_orders['completed_orders'];
					?>
				</div>
				<div class="stats">
					<div class="box stat-box">
						<div class="stat-icon">📦</div>
						<h5>Total Orders</h5>
						<p><?php echo $total_orders; ?></p>
					</div>
					<div class="box stat-box">
						<div class="stat-icon">💰</div>
						<h5>Total Penghasilan</h5>
						<p>Rp. <?php echo number_format($total_income); ?></p>
					</div>
					<div class="box stat-box">
						<div class="stat-icon">✅</div>
						<h5>Orderan Selesai</h5>
						<p><?php echo $completed_orders; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<!-- footer -->
	<footer class="footer">
 	 <p>&copy; 2026 TokoRent. All rights reserved.</p>
	</footer>
</body>
</html>