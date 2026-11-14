<?php
session_start();

include "../config/koneksi.php";
include "../validasi/validasi_register.php";

$semua_diskusi = selectAlldiskusi();
?>
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
                <th>Judul Diskusi & Isi Diskusi</th>
                <th>Kategori</th>
                <th>Pengirim</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no=1;
            if(!empty($semua_diskusi)):
                foreach($semua_diskusi as $row):
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td>
                    <strong><?php echo htmlspecialchars($row['judul']); ?></strong>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #444;">
                        <?php echo htmlspecialchars($row['isi_aspirasi']); ?>
                    </p>
                </td>
                <td><?php echo htmlspecialchars($row['nama_topik']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                <td>
                    <a href="tambah_respon.php">Berikan Tanggapan</a>
                    <br/><br/>
                    <a href="edit_respon.php">Edit Tanggapan</a>
                </td>
            </tr>
            <?php 
                endforeach; 
            else : 
            ?>
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada diskusi.</td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>