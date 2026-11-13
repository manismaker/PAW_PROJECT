<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi Saya - Aspirasi Daerah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="menu">
    <a href="dashboard.php">Dashboard</a>
    <a href="diskusi.php">Diskusi Saya</a>
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
                <th>Judul Diskusi & Deskripsi</th>
                <th>Kategori</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal</th>
            </tr>
            <tr>
                <td>1</td>
                <td>
                    <strong>Pemasangan Lampu Penerangan Jalan Umum</strong>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #444;">
                        Lampu penerangan di sepanjang jalan utama RT 03 padam dan rusak sejak minggu lalu, membuat jalanan gelap dan rawan kecelakaan di malam hari.
                    </p>
                </td>
                <td>Fasilitas Publik</td>
                <td>Budi Santoso</td>
                <td>08-11-2026</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <strong>Pemasangan Lampu Penerangan Jalan Umum</strong>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #444;">
                        Lampu penerangan di sepanjang jalan utama RT 03 padam dan rusak sejak minggu lalu, membuat jalanan gelap dan rawan kecelakaan di malam hari.
                    </p>
                </td>
                <td>Lingkungan</td>
                <td>Siti Rahmawati</td>
                <td>09-11-2026</td>
            </tr>
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

            <tr>
                <td>1</td>
                <td>Perbaikan Jalan di Wilayah Desa</td>
                <td>Infrastruktur</td>
                <td>10-11-2026</td>
                <td>
                    <a href="edit_diskusi.php">Edit</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Peningkatan Fasilitas Sekolah</td>
                <td>Pendidikan</td>
                <td>11-11-2026</td>
                <td>
                    <a href="edit_diskusi.php">Edit</a>
                </td>
            </tr>
        </table>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>