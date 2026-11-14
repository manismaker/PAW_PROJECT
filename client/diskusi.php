<?php
session_start();

include "../config/koneksi.php";
include "../validasi/validasi_register.php";

$semua_diskusi = selectAlldiskusi();

$id_user_login = $_SESSION['id'] ?? ($_SESSION['user_id'] ?? ($_SESSION['id_user'] ?? 0));
// Ambil khusus diskusi milik user yang sedang login untuk tabel bawah
$diskusi_saya = getDiskusiByUser($id_user_login);
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
    <h2>Semua Diskusi Warga</h2>
    <p>Daftar aspirasi dan topik diskusi publik yang diajukan oleh warga.</p>

     <div class="tabel-diskusi">
        <table>
            <tr>
                <th>No</th>
                <th>Judul Diskusi & Isi Diskusi</th>
                <th>Kategori</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal</th>
            </tr>
            <?php 
            $no = 1;
            if (!empty($semua_diskusi)) :
                foreach ($semua_diskusi as $row) : 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    <strong><?php echo htmlspecialchars($row['judul']); ?></strong>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #444;">
                        <?php echo htmlspecialchars($row['isi_aspirasi']); ?>
                    </p>
                </td>
                <td><?php echo htmlspecialchars($row['nama_topik']); ?></td> 
                <td><?php echo htmlspecialchars($row['nama']); ?></td>         
                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
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

    <hr style="margin: 40px 0; border: 0; border-top: 1px solid #ddd;">


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
            <?php 
            $no = 1;
            if (!empty($diskusi_saya)) :
                foreach ($diskusi_saya as $row) : 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['judul']); ?></td>
                <td><?php echo htmlspecialchars($row['nama_topik']); ?></td>
                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                <td>
                    <a href="edit_diskusi.php?id=<?php echo $row_s['id_diskusi']; ?>">Edit</a>
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