<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Expert - Aspirasi Daerah</title>
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

    <div class="dashboard-client">
        <h2>Dashboard Expert</h2>
        <p>Selamat datang di halaman Expert Aspirasi Daerah.</p>
        <p>Melalui halaman ini, Anda dapat melihat berbagai topik diskusi masyarakat dan memberikan tanggapan atau informasi yang bermanfaat.</p>
    </div>

    <div class="fitur-client">
        <h2>Menu Expert</h2>

        <div class="daftar-fitur">

            <div class="kartu-fitur">
                <h3>Profil Saya</h3>
                <p>Lihat dan ubah informasi profil akun Anda.</p>
                <a href="profil.php">Kelola Profil</a>
            </div>

            <div class="kartu-fitur">
                <h3>Daftar Diskusi</h3>
                <p>Lihat berbagai topik diskusi yang tersedia dalam forum.</p>
                <a href="diskusi.php">Lihat Diskusi</a>
            </div>

        </div>
    </div>

</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>