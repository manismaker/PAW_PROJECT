<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Diskusi - Aspirasi Daerah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="diskusi.php">Diskusi</a>
    <a href="profil.php">Profil</a>
    
    <a href="../logout.php">Logout</a>
</div>

<div class="content">

    <h2>Daftar Diskusi</h2>
    <p>Lihat berbagai topik aspirasi masyarakat dan berikan tanggapan yang bermanfaat.</p>

    <div class="tabel-diskusi">
        <table>
            <tr>
                <th>No</th>
                <th>Judul Diskusi</th>
                <th>Kategori</th>
                <th>Pengirim</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Perbaikan Jalan di Wilayah Desa</td>
                <td>Infrastruktur</td>
                <td>Client 1</td>
                <td>10-11-2026</td>
                <td>
                    <a href="tambah_respon.php">Berikan Tanggapan</a>
					<a href="edit_respon.php">Edit Tanggapan</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Peningkatan Fasilitas Sekolah</td>
                <td>Pendidikan</td>
                <td>Client 2</td>
                <td>11-11-2026</td>
                <td>
                    <a href="tambah_respon.php">Berikan Tanggapan</a>
					<a href="edit_respon.php">Edit Tanggapan</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Pengelolaan Sampah di Lingkungan Desa</td>
                <td>Lingkungan</td>
                <td>Client 3</td>
                <td>12-11-2026</td>
                <td>
                    <a href="tambah_respon.php">Berikan Tanggapan</a>
					<a href="edit_respon.php">Edit Tanggapan</a>
                </td>
            </tr>
        </table>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>