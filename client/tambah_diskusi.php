<?php
session_start();

include "../config/koneksi.php";
include "../validasi/validasi_register.php";
$pesan_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $judul        = trim($_POST['judul'] ?? '');
    $id_topik     = $_POST['kategori'] ?? ''; 
    $isi_aspirasi = trim($_POST['isi_diskusi'] ?? '');
    $id_user      = $_SESSION['id'] ?? 0;     

    // Validasi sederhana agar tidak kosong
    if (empty($judul) || empty($id_topik) || empty($isi_aspirasi)) {
        $pesan_error = "Semua kolom wajib diisi!";
    }// Panggil fungsi tambah_diskusi yang sudah kita buat 
    else {
        $sukses = tambah_diskusi($judul, $isi_aspirasi, $id_topik, $id_user);
        // Jika berhasil disimpan, alihkan kembali ke halaman diskusi
        if ($sukses) {
            header("location: diskusi.php");
            exit();
        } else {
            $pesan_error = "Gagal menyimpan diskusi ke database.";
        }
    }
}

$daftar_topik = getTopik();
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
    <a href="diskusi.php">Diskusi</a>
    <a href="profil.php">Profil</a>
    
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
                        <select name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php 
                            // Mengambil data topik dari database secara dinamis
                            $daftar_topik = getTopik();
                            if (!empty($daftar_topik)) :
                                foreach ($daftar_topik as $topik) : 
                            ?>
                                <!-- Value diisi id_topik agar sesuai dengan relasi database -->
                                <option value="<?php echo $topik['id_topik']; ?>">
                                    <?php echo htmlspecialchars($topik['nama_topik']); ?>
                                </option>
                            <?php 
                                endforeach; 
                            endif; 
                            ?>
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
            <a href="diskusi.php">Kembali ke Diskusi</a>
        </p>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>