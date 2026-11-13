<?php

include "../config/koneksi.php";
include "../validasi/validasi_register.php";

$Data_user = selectAll();

$error1 = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$nama_lengkap = $_POST['nama'] ?? '';
	$username = $_POST['username'] ?? '';
	$email = $_POST['email'] ?? '';
	$telepon = $_POST['no_telepon'] ?? '';
	$alamat = $_POST['alamat'] ?? '';

	$error = [];
	nama_lengkap($error, $nama_lengkap);
	username($error, $username);
	email($error, $email);
	no_telepon($error, $telepon);
	alamat($error, $alamat);

	if(!empty($error)){
		$error1 = "Perubahan profil gagal, input dengan benar";
	} else {
		$user = $_SESSION['user_id'];
		try {
			$statement = $dbc->prepare("UPDATE user SET nama_lengkap = :nama_lengkap, nama = :username, email = :email, no_telepon = :no_telepon, alamat = :alamat WHERE id = :user_id");
			$statement->bindValue(':nama_lengkap', $nama_lengkap);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':email', $email);
			$statement->bindValue(':no_telepon', $telepon);
			$statement->bindValue(':alamat', $alamat);
			$statement->bindValue(':user_id', $user);

			$statement->execute();
			header("Location: profil.php");
			exit();
		} catch (PDOException $ex) {
			$error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
			error_log("Error", $ex->getMessage());
		}
}
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client - Aspirasi Daerah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
	<a href="diskusi.php">Diskusi Saya</a>
    <a href="profil.php">Profil</a>
    
    <a href="../logout.php">Logout</a>
</div>

<div class="content">

    
	<h2>Profil Saya</h2>
	<p>Kelola informasi akun Anda pada halaman ini.</p>

	<div class="informasi-profil">
		<h3>Informasi Profil</h3>
		<table>
			<tr>
				<td>Nama Lengkap</td>
				<td>:</td>
				<td><?= $Data_user['nama_lengkap']?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?= $Data_user['nama']?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><?= $Data_user['email']?></td>
			</tr>
			<tr>
				<td>Nomor Telepon</td>
				<td>:</td>
				<td><?= $Data_user['no_telepon']?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>Alamat Client</td>
			</tr>
		</table>
	</div>

	<div class="form-profil">
		<h3>Edit Profil</h3>
		<form method="POST" action="profil.php">
			<table>
				<tr>
					<td>Nama Lengkap</td>
					<td><input type="text" name="nama" placeholder="Masukkan nama lengkap"></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" placeholder="Masukkan username"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" placeholder="Masukkan email"></td>
				</tr>
				<tr>
					<td>Nomor Telepon</td>
					<td><input type="text" name="no_telepon" placeholder="Masukkan nomor telepon"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><textarea name="alamat" placeholder="Masukkan alamat"></textarea></td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" name="simpan">Simpan Perubahan</button>
					</td>
				</tr>
			</table>
		</form>
	</div>


</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>