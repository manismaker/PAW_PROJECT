<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diskusi - Aspirasi Daerah</title>
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

    <h2>Edit Diskusi</h2>
    <p>Perbarui informasi topik diskusi yang telah Anda buat.</p>

    <div class="form-tambah-diskusi">
        <form method="POST" action="edit_diskusi.php">
            <table>
                <tr>
                    <td>Judul Diskusi</td>
                    <td>
                        <input type="text" name="judul" value="Perbaikan Jalan di Wilayah Desa">
                    </td>
                </tr>

                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="kategori">
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Infrastruktur" selected>Infrastruktur</option>
                            <option value="Ekonomi">Ekonomi</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Pelayanan Publik">Pelayanan Publik</option>
                            <option value="Sosial dan Budaya">Sosial dan Budaya</option>
                            <option value="Keamanan dan Ketertiban">Keamanan dan Ketertiban</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Isi Diskusi</td>
                    <td>
                        <textarea name="isi_diskusi">Saya ingin menyampaikan aspirasi mengenai kondisi jalan di wilayah desa yang masih rusak dan membutuhkan perbaikan.</textarea>
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
            <a href="diskusi.php">Kembali ke Diskusi Saya</a>
        </p>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>