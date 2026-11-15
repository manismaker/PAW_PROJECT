<?php
include "../validasi/permission.php";
include "../config/koneksi.php";
include "../validasi/validasi_inputan.php";

if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if($_SESSION['status'] === 'expert'){
        header("location: expert/dashboard.php");
        exit();
    } elseif($_SESSION['status'] === 'client'){
        header("location: client/dashboard.php");
        exit();
    }
}

$id_diskusi = $_GET['id_diskusi'] ?? null;
$id_user    = $_SESSION['id'] ?? $_SESSION['id_user'] ?? null; 

if (!$id_diskusi) {
    header("Location: diskusi.php");
    exit();
}

$error1 = "";
$error  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggapan = $_POST['isi_respon'] ?? '';

    validateTanggapan($error, $tanggapan);

    if (!empty($error)) {
        $error1 = "Anda harus mengisi tanggapan sebelum mengirim."; 
    } else {
        try {
            update_respon($tanggapan, $id_diskusi, $id_user);
            header("Location: edit_respon.php?id_diskusi=$id_diskusi&status=sukses");
            exit();
        } catch (PDOException $ex) {
            error_log("Gagal memperbarui tanggapan: " . $ex->getMessage());
            $error1 = "Terjadi kesalahan saat memperbarui tanggapan.";
        }
    }
}

try {
    $statement = $dbc->prepare("SELECT diskusi.*, topik.nama_topik, user.nama, respon.id_respon, respon.isi_respon
                                FROM diskusi 
                                JOIN topik ON diskusi.id_topik = topik.id_topik
                                JOIN user ON diskusi.id_user = user.id_user
                                JOIN respon ON diskusi.id_diskusi = respon.id_diskusi
                                WHERE diskusi.id_diskusi = :id_diskusi");

    $statement->bindValue(':id_diskusi', $id_diskusi);
    $statement->execute();

    $Data_respon = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$Data_respon) {
        header("Location: diskusi.php");
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

    <?php if (isset($_GET['status']) && $_GET['status'] === 'sukses'): ?>
        <p style="color: green;">Tanggapan berhasil diperbarui!</p>
    <?php endif; ?>

    <?php if (!empty($error1)): ?>
        <p style="color: red;"><?= htmlspecialchars($error1) ?></p>
    <?php endif; ?>

    <div class="informasi-diskusi">
        <h3>Informasi Diskusi</h3>

        <table>
            <tr>
                <td>Judul Diskusi</td>
                <td>:</td>
                <td><?= htmlspecialchars($Data_respon['judul']) ?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td><?= htmlspecialchars($Data_respon['nama_topik']) ?></td>
            </tr>
            <tr>
                <td>Pengirim</td>
                <td>:</td>
                <td><?= htmlspecialchars($Data_respon['nama']) ?></td>
            </tr>
            <tr>
                <td>Isi Diskusi</td>
                <td>:</td>
                <td><?= htmlspecialchars($Data_respon['isi_aspirasi']) ?></td>
            </tr>
        </table>
    </div>

    <div class="form-respon">
        <h3>Edit Tanggapan</h3>

        <form method="POST" action="">
            <table>
                <tr>
                    <td>Tanggapan</td>
                    <td>
                        <textarea name="isi_respon"><?= htmlspecialchars($Data_respon['isi_respon']) ?></textarea>
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
