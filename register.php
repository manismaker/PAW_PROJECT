<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Ruang Aspirasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Ruang Aspirasi</h1>
        <p>Register Pengguna</p>
    </header>

    <main>
        
        <div class="form-login">
            <h2>Daftar Akun Baru</h2>
            <p>Silakan isi data di bawah ini untuk membuat akun.</p>

            <form action="" method="POST">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" >

                <label>Email</label>
                <input type="email" name="email">

                <label>No Telepon</label>
                <input type="text" name="no_telepon" >

                <label>Username</label>
                <input type="text" name="username" >

                <label>Password</label>
                <input type="password" name="password">

                <label>Daftat Sebagai : PENUMPANG </label>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 5px; margin-bottom: 15px;">
                    <span>Expert</span><input type="radio" name="role" value="expert" style="width: auto; margin: 0;">
                    <span>Client</span><input type="radio" name="role" value="client" style="width: auto; margin: 0;">
                </div>
  

                <button type="submit" name="register">Daftar Sekarang</button>
            </form>

    </main>

    <footer>
        <p>&copy; 2026 Ruang Aspirasi</p>
    </footer>

</body>
</html>
