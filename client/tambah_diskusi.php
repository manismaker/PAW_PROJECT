<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Diskusi - Aspirasi Daerah</title>
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

    <h2>Buat Diskusi Baru</h2>
    <p>Sampaikan aspirasi dan permasalahan yang ingin Anda diskusikan.</p>

    <div class="form-tambah-diskusi">
        <form method="POST" action="tambah_diskusi.php">
            <table>
                <tr>
                    <td>Judul Diskusi</td>
                    <td>
                        <input type="text" name="judul" placeholder="Masukkan judul diskusi">
                    </td>
                </tr>

                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Infrastruktur">Infrastruktur</option>
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
                        <textarea name="isi_diskusi" placeholder="Tuliskan aspirasi atau permasalahan yang ingin didiskusikan"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" name="simpan">Kirim Diskusi</button>
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