<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tanggapan - Aspirasi Daerah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="profil.php">Profil</a>
    <a href="diskusi.php">Diskusi</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="content">

    <h2>Edit Tanggapan</h2>
    <p>Perbarui tanggapan yang telah Anda berikan pada topik diskusi.</p>

    <div class="informasi-diskusi">
        <h3>Informasi Diskusi</h3>

        <table>
            <tr>
                <td>Judul Diskusi</td>
                <td>:</td>
                <td>Perbaikan Jalan di Wilayah Desa</td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td>Infrastruktur</td>
            </tr>
            <tr>
                <td>Pengirim</td>
                <td>:</td>
                <td>Client 1</td>
            </tr>
            <tr>
                <td>Isi Diskusi</td>
                <td>:</td>
                <td>Kondisi jalan di wilayah desa masih rusak dan membutuhkan perbaikan.</td>
            </tr>
        </table>
    </div>

    <div class="form-respon">
        <h3>Edit Tanggapan</h3>

        <form method="POST" action="edit_respon.php">
            <table>
                <tr>
                    <td>Tanggapan</td>
                    <td>
                        <textarea name="isi_respon">Perbaikan jalan perlu menjadi perhatian pemerintah daerah agar akses masyarakat menjadi lebih baik.</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="simpan">Simpan Perubahan</button>
                    </td>
                </tr>
            </table>
        </form>

        <p class="kembali-diskusi">
            <a href="diskusi.php">Kembali ke Daftar Diskusi</a>
        </p>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>