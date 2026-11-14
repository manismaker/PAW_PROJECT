<?php 
session_start();
include "../config/koneksi.php";
include "../validasi/validasi_register.php";

// 1. Cek apakah user sudah login. Jika belum, kembalikan ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['id'];
$error1 = "";
$sukses = "";

// 2. Proses UPDATE data jika form disubmit (diletakkan sebelum SELECT agar data langsung ter-refresh)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = $_POST['nama'] ?? '';
    $username     = $_POST['username'] ?? '';
    $email        = $_POST['email'] ?? '';
    $telepon      = $_POST['no_telepon'] ?? '';
    $alamat       = $_POST['alamat'] ?? '';

    $error = [];
    nama_lengkap($error, $_POST, 'nama');
    username($error, $_POST, 'username');
    email($error, $_POST, 'email');
    no_telepon($error, $_POST, 'no_telepon');
    alamat($error, $_POST, 'alamat');

    if (!empty($error)) {
        $error1 = "Perubahan profil gagal, pastikan semua input diisi dengan benar.";
    } else {
        try {
            $statement = $dbc->prepare("UPDATE user SET nama_lengkap = :nama_lengkap, nama = :username, email = :email, no_telepon = :no_telepon, alamat = :alamat WHERE id_user = :id_user");
            $statement->bindValue(':nama_lengkap', $nama_lengkap);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':no_telepon', $telepon);
            $statement->bindValue(':alamat', $alamat);
            $statement->bindValue(':id_user', $user_id);
            $statement->execute();

            header("Location: profil.php?status=sukses");
            exit();
        } catch (PDOException $ex) {
            $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
            error_log("Error Update Profil: " . $ex->getMessage());
        }
    }
}

// 3. Ambil data spesifik 1 user berdasarkan user_id yang sedang login
try {
    $stmt_user = $dbc->prepare("SELECT * FROM user WHERE id_user = :id_user LIMIT 1");
    $stmt_user->bindValue(':id_user', $user_id);
    $stmt_user->execute();
    $Data_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    // Jika data user tidak ditemukan di database
    if (!$Data_user) {
        session_destroy();
        header("Location: ../login.php");
        exit();
    }
} catch (PDOException $ex) {
    die("Gagal mengambil data profil.");
}

// Tampung ke variabel agar mudah dipanggil di HTML
$lengkap = $Data_user['nama_lengkap'] ?? '';
$user    = $Data_user['nama'] ?? '';
$mail    = $Data_user['email'] ?? '';
$nomor   = $Data_user['no_telepon'] ?? '';
$alamat  = $Data_user['alamat'] ?? '';
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
        <a href="diskusi.php">Diskusi</a>
        <a href="profil.php">Profil</a>
        <a href="../logout.php">Logout</a>
    </div>

    <div class="content">
        <h2>Profil Saya</h2>
        <p>Kelola informasi akun Anda pada halaman ini.</p>

        <!-- Menampilkan pesan error atau sukses -->
        <?php if (!empty($error1)): ?>
            <p style="color: red;"><?= htmlspecialchars($error1) ?></p>
        <?php endif; ?>
        
        <?php if (isset($_GET['status']) && $_GET['status'] === 'sukses'): ?>
            <p style="color: green;">Profil berhasil diperbarui!</p>
        <?php endif; ?>

        <div class="informasi-profil">
            <h3>Informasi Profil</h3>
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($lengkap) ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($user) ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($mail) ?? '' ?></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($nomor) ?></td>
                    <br/>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($alamat) ?></td>
                </tr>
            </table>
        </div>

        <div class="form-profil">
            <h3>Edit Profil</h3>
            <form method="POST" action="profil.php">
                <table>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td><input type="text" name="nama" value="<?= htmlspecialchars($lengkap) ?>" placeholder="Masukkan nama lengkap">
                        <br/>
                        <span><?= $error['nama'] ?? '' ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?= htmlspecialchars($user) ?>" placeholder="Masukkan username">
                        <br/>
                        <span><?= $error['username'] ?? '' ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?= htmlspecialchars($mail) ?>" placeholder="Masukkan email">
                        <br/>
                        <span><?= $error['email'] ?? '' ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td><input type="text" name="no_telepon" value="<?= htmlspecialchars($nomor) ?>" placeholder="Masukkan nomor telepon">
                        <br/>
                        <span><?= $error['no_telepon'] ?? '' ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat" placeholder="Masukkan alamat"><?= htmlspecialchars($alamat) ?></textarea>
                        <br/>
                        <span><?= $error['alamat'] ?? '' ?></span>
                    </td>
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
