<?php
include "../validasi/permission.php";
include "../config/koneksi.php";
include "../validasi/validasi_inputan.php";

$error1 = "";
// Ubah bagian ini
$id_diskusi = $_GET['id_diskusi'] ?? $_POST['id_diskusi'] ?? null;
$id_user = $_SESSION['id'] ?? null;
$id_respon = $_GET['id_respon'] ?? $_POST['id_respon'] ?? null;
var_dump($id_respon);

$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $isi_respon = $_POST['isi_respon'];
    validateTanggapan($error, $isi_respon);
    try{
    update_respon($isi_respon, $id_diskusi, $id_user, $id_respon);

    header("Location: diskusi.php?id_diskusi=$id_diskusi&status=sukses");
    exit();
    }catch(PDOException $ex){
        $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
        error_log($ex->getMessage());
    }
}

try {
    $statement = $dbc->prepare("SELECT 
                                    r.id_user AS pemilik_respon, /* <-- TAMBAHKAN INI */
                                    d.id_diskusi,
                                    d.judul,
                                    t.nama_topik AS kategori,
                                    u.nama AS pengirim,
                                    d.isi_aspirasi AS isi_diskusi,
                                    r.isi_respon 
                                FROM 
                                    respon r
                                JOIN 
                                    diskusi d ON r.id_diskusi = d.id_diskusi
                                JOIN 
                                    user u ON d.id_user = u.id_user
                                JOIN 
                                    topik t ON d.id_topik = t.id_topik
                                WHERE 
                                    r.id_respon = :id_respon");
    
    $statement->bindValue(':id_respon', $id_respon); 
    $statement->execute();
    $Data_diskusi = $statement->fetch(PDO::FETCH_ASSOC);

    // Jika data tidak ditemukan
    if (!$Data_diskusi) {
        header("Location: diskusi.php");
        exit();
    }

    // --- TAMBAHKAN BLOK PENGECEKAN INI ---
    // Jika ID pembuat respon tidak sama dengan ID user yang sedang login
    if ($Data_diskusi['pemilik_respon'] != $id_user) {
        header("Location: diskusi.php?status=akses_ditolak");
        exit();
    }
} catch (PDOException $ex) {
    $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
    error_log($ex->getMessage());
}

?>

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
    <a href="diskusi.php">Diskusi</a>
    <a href="profil.php">Profil</a>
    
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
                <td><?= htmlspecialchars($Data_diskusi['judul'] ?? '') ?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <!-- PERBAIKAN DI SINI: Sesuaikan dengan alias di query (kategori) -->
                <td><?= htmlspecialchars($Data_diskusi['kategori'] ?? '') ?></td> 
            </tr>
            <tr>
                <td>Pengirim</td>
                <td>:</td>
                <!-- PERBAIKAN DI SINI: Sesuaikan dengan alias di query (pengirim) -->
                <td><?= htmlspecialchars($Data_diskusi['pengirim'] ?? '') ?></td> 
            </tr>
            <tr>
                <td>Isi Diskusi</td>
                <td>:</td>
                <!-- PERBAIKAN DI SINI: Sesuaikan dengan alias di query (isi_diskusi) -->
                <td><?= htmlspecialchars($Data_diskusi['isi_diskusi'] ?? '') ?></td> 
            </tr>
        </table>
    </div>

    <div class="form-respon">
        <h3>Edit Tanggapan</h3>

        <form method="POST" action="edit_respon.php">
            <input type="hidden" name="id_respon" value="<?= htmlspecialchars($id_respon) ?>">
            <input type="hidden" name="id_diskusi" value="<?= htmlspecialchars($Data_diskusi['id_diskusi'] ?? '') ?>">
            <table>
                <tr>
                    <td>Tanggapan</td>
                    <td>
                        <textarea name="isi_respon"><?= htmlspecialchars($Data_diskusi['isi_respon'] ?? '') ?></textarea>   
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