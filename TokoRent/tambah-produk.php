<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
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
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="index.php">TokoRent</a></h1>
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
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php
						$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
						while ($r = mysqli_fetch_array($kategori)) {
						?>
							<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
					<input type="text" name="harga" class="input-control" placeholder="Harga" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					// menampung inputan dari form
					$kategori 	= $_POST['kategori'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$deskripsi 	= $_POST['deskripsi'];
					$status 	= $_POST['status'];

					// validasi harga harus numerik
					if (!is_numeric($harga)) {
						echo '<script>alert("Harga harus berupa angka")</script>';
					} else {
						// menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = strtolower(end($type1)); // ambil ekstensi terakhir dan lowercase

						$newname = 'produk' . time() . '.' . $type2;

						// proses upload file (izinkan semua format)
						if (move_uploaded_file($tmp_name, './produk/' . $newname)) {
							// jika upload berhasil, insert ke database
							$insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
											null,
											'" . $kategori . "',
											'" . $nama . "',
											'" . $harga . "',
											'" . $deskripsi . "',
											'" . $newname . "',
											'" . $status . "',
											null
												) ");

							if ($insert) {
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="data-produk.php"</script>';
							} else {
								echo '<script>alert("Gagal menambah data: ' . mysqli_error($conn) . '")</script>';
							}
						} else {
							echo '<script>alert("Gagal upload gambar")</script>';
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
	<script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>