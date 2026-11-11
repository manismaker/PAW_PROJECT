<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Aspirasi Daerah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <main>
        
        <div class="form-login">
            <h2>Daftar Akun</h2>
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

                <label>Daftar Sebagai :</label>
                <div style="display: flex;  gap: 5px; margin-top: 5px; margin-bottom: 5px;">
                    <input type="radio" name="role">Expert
                    <input type="radio" name="role">Client
                </div>
                
                <button type="submit" name="register">Daftar Sekarang</button>
            </form>

    </main>

</body>
</html>
