<?php
    include "config/koneksi.php";

    session_start();

    // if(isset($_SESSION['is_login'])){
    //     header("location: dashboard.php");
    //     exit;
    // }

    $error1 = "";
    if(isset($_POST['register'])){
        include "validasi/validasi_login.php";
        if(!empty($error)){
            $error1 = "Daftar gagal, input dengan benar";
        }else{
            $hashPW = hash('sha256', $passwd);
            
            try{
                $statement = $dbc->prepare("INSERT INTO user (nama, email, password, status, alamat) VALUES (:nama, :email, :password, :status, :alamat)");
                // $statement->bindValue(':#', $nama_lengkap);
                $statement->bindValue(':nama', $username);
                $statement->bindValue(':email', $email);
                // $statement->bindValue(':no_telepon', $telepon);
                $statement->bindValue(':password', $hashPW);
                $statement->bindValue(':status', $role);
                $statement->bindValue(':alamat', $alamat);

                $statement->execute();
                $sukses = "Pendaftaran berhasil! Silakan masuk ke akun Anda.";
                $_POST = [];   
            }catch(PDOException $ex){  
                if ($ex->getCode() == 23000) {
                    $error1 = "Email atau username sudah digunakan.";
                } else {
                    $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
                }
                error_log($ex->getMessage());
            }
        }
    }

?>


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
                <span><?= $error['lengkap'] ?? '' ?></span>

                <label>Email</label>
                <input type="email" name="email">
                <span><?= $error['mail'] ?? '' ?></span>

                <label>No Telepon</label>
                <input type="text" name="no_telepon" >
                <span><?= $error['nomor'] ?? '' ?></span>

                <label>Username</label>
                <input type="text" name="username" >
                <span><?= $error['nama'] ?? '' ?></span>

                <label>Password</label>
                <input type="password" name="password">
                <span><?= $error['passwd'] ?? '' ?></span>

                <label for="alamat">Alamat Lengkap:</label><br>
                <textarea id="alamat" name="alamat" rows="4" cols="38" placeholder="Contoh: Jl. Merdeka No. 10, RT 01/RW 02, Kelurahan..."></textarea><br/>
                <span><?= $error['alamat'] ?? '' ?></span>


                <label>Daftat Sebagai: </label>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 5px; margin-bottom: 15px;">
                    <input type="radio" name="role" value="expert" style="width: auto; margin: 0;"><span>Expert</span>
                    <input type="radio" name="role" value="client" style="width: auto; margin: 0;"><span>Client</span>
                </div><br/>
                <span><?= $error['role'] ?? '' ?></span>
  

                <button type="submit" name="register">Daftar Sekarang</button>
            </form>

    </main>

    <footer>
        <p>&copy; 2026 Ruang Aspirasi</p>
    </footer>

</body>
</html>
