<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi Saya - Aspirasi Daerah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="profil.php">Profil</a>
    <a href="diskusi.php">Diskusi Saya</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="content">

    <h2>Diskusi Saya</h2>
    <p>Daftar topik diskusi yang telah Anda buat.</p>

    <div class="tambah-diskusi">
        <a href="tambah_diskusi.php">+ Buat Diskusi Baru</a>
    </div>

    <div class="tabel-diskusi">
        <table>
            <tr>
                <th>No</th>
                <th>Judul Diskusi</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Perbaikan Jalan di Wilayah Desa</td>
                <td>Infrastruktur</td>
                <td>10-11-2026</td>
                <td>
                    <a href="edit_diskusi.php">Edit</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Peningkatan Fasilitas Sekolah</td>
                <td>Pendidikan</td>
                <td>11-11-2026</td>
                <td>
                    <a href="edit_diskusi.php">Edit</a>
                </td>
            </tr>
        </table>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>