<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client - Aspirasi Daerah</title>
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

    <div class="dashboard-client">
        <h2>Dashboard Client</h2>
        <p>Selamat datang di halaman pengguna Aspirasi Daerah.</p>
        <p>Melalui halaman ini, Anda dapat menyampaikan aspirasi dan mengikuti diskusi mengenai kebijakan publik.</p>
    </div>

    <div class="fitur-client">
        <h2>Menu Pengguna</h2>

        <div class="daftar-fitur">
            <div class="kartu-fitur">
                <h3>Profil Saya</h3>
                <p>Lihat dan ubah informasi profil akun Anda.</p>
                <a href="profil.php">Kelola Profil</a>
            </div>

            <div class="kartu-fitur">
                <h3>Diskusi Saya</h3>
                <p>Lihat dan kelola topik diskusi yang telah dibuat.</p>
                <a href="diskusi.php">Lihat Diskusi</a>
            </div>

            <div class="kartu-fitur">
                <h3>Buat Diskusi</h3>
                <p>Sampaikan aspirasi melalui topik diskusi baru.</p>
                <a href="tambah_diskusi.php">Buat Topik</a>
            </div>
        </div>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>