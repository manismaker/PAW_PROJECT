
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Ruang Aspirasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Ruang Aspirasi</h1>
        <p>Login Pengguna</p>
    </header>

    <main>
        <div class="form-login">
            <h2>Masuk ke Akun</h2>
            <p>Silakan masukkan username dan password Anda.</p>

            <form action="" method="POST">
                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
                <input type="password" name="password">

                <button type="submit" name="login">Login</button>
            </form>

            <p>Belum memiliki akun?
                <a href="register.php">Daftar di sini</a>
            </p>

            <a href="index.php">Kembali ke Beranda</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Ruang Aspirasi</p>
    </footer>

</body>
</html>
