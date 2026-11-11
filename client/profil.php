<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aspirasi Daerah - Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Aspirasi Daerah</h1>
        <p>Suara Masyarakat, Perubahan Bersama</p>
    </header>
    <nav>
        <a href="index.php">Beranda</a>
        <a href="#diskusi">Dashboard</a>
        <a href="#diskusi">Diskusi</a>
        <a href="login.php">Login</a>
        <a href="register.php">Daftar</a>
    </nav>
    <main>
        <div class="profile-card">
            <div class="profile-header-flex">
                <div>
                    <h2>Profil Pengguna</h2>
                    <p>Kelola data informasi akun dan preferensi Anda di Ruang Aspirasi.</p>
                </div>
                <span class="badge-role">Role: Client</span>
            </div>

            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="Erick" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="erick_id" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="erick@mhs.ac.id" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">No Telepon / HP</label>
                        <input type="text" id="telepon" name="telepon" value="0812-3456-7890">
                    </div>
                </div>

                <div class="section-divider">
                    <h3>Ganti Kata Sandi (Opsional)</h3>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" placeholder="Masukkan kata sandi lama">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" placeholder="Masukkan kata sandi baru">
                    </div>
                </div>

                <div class="profile-actions">
                    <button type="submit" class="tombol btn-simpan">Simpan Data</button>
                    <a href="../logout.php" class="btn-logout-red">Logout / Keluar</a>
                </div>
            </form>
        </div>

    </main>

    <footer>
        <p>&copy; 2026 Aspirasi Daerah</p>
    </footer>

</body>
</html>
