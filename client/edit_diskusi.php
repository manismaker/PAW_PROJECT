<?php
include "../validasi/permission.php";
include "../config/koneksi.php";
include "../validasi/validasi_inputan.php";

$id_diskusi = $_GET['id_diskusi'] ?? $_POST['id_diskusi'] ?? null;



$error1 = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $isi_aspirasi = $_POST['isi_diskusi'] ?? '';

    try {
        $statement = $dbc->prepare("UPDATE diskusi 
                                    SET judul = :judul, 
                                        id_topik = :id_topik, 
                                        isi_aspirasi = :isi_aspirasi,
                                        tanggal = NOW()
                                    WHERE id_diskusi = :id_diskusi");

        $statement->bindValue(':id_diskusi', $id_diskusi);
        $statement->bindValue(':judul', $judul);
        $statement->bindValue(':id_topik', $kategori);
        $statement->bindValue(':isi_aspirasi', $isi_aspirasi);

        $statement->execute();

        header("Location: diskusi.php?id_diskusi=" . urlencode($id_diskusi) . "&status=sukses");
        exit();

    } catch (PDOException $ex) {
        $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
        error_log("Error Update Diskusi: " . $ex->getMessage());
    }
}

try{
    $statement = $dbc->prepare("SELECT * FROM diskusi JOIN topik ON diskusi.id_topik = topik.id_topik WHERE id_diskusi = :id_diskusi");
    $statement->bindValue('id_diskusi', $id_diskusi);
    $statement->execute();
    $data_diskusi = $statement->fetch(PDO::FETCH_ASSOC);

    if(!$data_diskusi){
        header('location: diskusi.php');
        exit();
    }
}catch(PDOException $er){
    echo "terjadi kesalah di sistem silahkan coba lagi";
}

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
    <a href="diskusi.php">Diskusi</a>
    <a href="profil.php">Profil</a>
    
    <a href="../logout.php">Logout</a>
</div>

<div class="content">

    <h2>Edit Diskusi</h2>
    <p>Perbarui informasi topik diskusi yang telah Anda buat.</p>

    <div class="form-tambah-diskusi">
        <form method="POST" action="edit_diskusi.php">
            <input type="hidden" name="id_diskusi" value="<?= $data_diskusi['id_diskusi'] ?>">
            <table>
                <tr>
                    <td>Judul Diskusi</td>
                    <td>
                        <input type="text" name="judul" value="<?= $data_diskusi['judul']?>">
                    </td>
                </tr>

                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="kategori">
                            <option value="<?= $data_diskusi['id_topik'] ?>" selected>
                                <?= htmlspecialchars($data_diskusi['nama_topik']) ?>
                            </option>

                            <?php
                            $daftar_topik = getTopik();
                                foreach ($daftar_topik as $topik) :
                                    if ($topik['id_topik'] != $data_diskusi['id_topik']) :
                            ?>
                                        <option value="<?= $topik['id_topik'] ?>">
                                            <?= htmlspecialchars($topik['nama_topik']) ?>
                                        </option>
                            <?php
                                    endif;
                                endforeach;
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Isi Diskusi</td>
                    <td>
                        <textarea name="isi_diskusi"><?= $data_diskusi['isi_aspirasi']?></textarea>
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