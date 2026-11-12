<?php

    session_start();

    include "config/koneksi.php";
    include "validasi/validasi_register.php";

    if(isset($_SESSION['login'])) {
        if($_SESSION['status'] === 'expert'){
            header("location: expert/dashboard.php");
            exit;
        } elseif($_SESSION['status'] === 'client'){
            header("location: client/dashboard.php");
            exit;
        }
    }

    $error1 = "";
    if(isset($_POST['login'])){
        $username = $_POST['username'] ?? '';
        $passwd = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        $error = [];
        username($error, $username);
        password($error, $passwd);
        role($error, $role);

        if(!empty($error)){
            $error1 = "Login gagal, input dengan benar";
        }else{
            $hashPW = hash('sha256', $passwd);
            try{
                $statement = $dbc->prepare("SELECT * FROM user WHERE nama = :username  AND password = :password AND status = :status");
                $statement->bindValue(':username', $username);
                $statement->bindValue(':password', $hashPW);
                $statement->bindValue(':status', $role);

                $statement->execute();

                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if($user){
                    // Simpan sesi login
                    $_SESSION['is_login'] = true;
                    $_SESSION['user_id']  = $user['id'] ?? '';
                    $_SESSION['username'] = $user['nama'];
                    $_SESSION['status']   = $user['status'];

                    if($user['status'] === 'expert'){
                        header("location: expert/dashboard.php");
                        exit;
                    } elseif($user['status'] === 'client'){
                        header("location: client/dashboard.php");
                        exit;
                    }
                } else {
                    // Jika data tidak ditemukan di database
                    $error1 = "Username, password, atau role salah.";
                }
            } catch(PDOException $ex) {
                $error1 = "Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.";
                error_log($ex->getMessage());
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Aspirasi Daerah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <main>
        <div class="form-login">
            <h2>Masuk ke Akun</h2>
            <p>Silakan masukkan username dan password Anda.</p>

            <span><?= $error1 ?? '' ?></span>

            <form action="" method="POST">
                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
                <input type="password" name="password">

                <label>Login Sebagai: </label>
                <div style="display: flex; align-items: center; gap: 15px; margin-top: 5px; margin-bottom: 15px;">
                    <input type="radio" name="role" value="expert" style="width: auto; margin: 0;"><span>Expert</span>
                    <input type="radio" name="role" value="client" style="width: auto; margin: 0;"><span>Client</span>
                </div>

                <button type="submit" name="login">Login</button>
            </form>

            <p>Belum memiliki akun?
                <a href="register.php">Daftar di sini</a>
            </p>

            <a href="index.php">Kembali ke Beranda</a>
        </div>
    </main>

    

</body>
</html>
