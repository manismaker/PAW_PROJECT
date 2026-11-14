<?php

session_start();

include "config/koneksi.php";
include "validasi/validasi_register.php";

if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
    if($_SESSION['status'] === 'expert'){
        header("location: expert/dashboard.php");
        exit();
    } elseif($_SESSION['status'] === 'client'){
        header("location: client/dashboard.php");
        exit();
    }
}

$error1 = "";
$error = [];
$username = "";
$passwd = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $passwd = $_POST['password'] ?? '';

    username($error, $_POST, 'username');
    password($error, $_POST, 'password');

    if(!empty($error)){
        $error1 = "Login gagal, input dengan benar";
    }else{
        $hashPW = hash('sha256', $passwd);

        try{
            $statement = $dbc->prepare("SELECT * FROM user WHERE nama = :username AND password = :password");
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $hashPW);

            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if($user){
                // Simpan sesi login
                $_SESSION['login'] = true;
                $_SESSION['id'] = $user['id_user'];
                $_SESSION['user_lengkap'] = $user['nama_lengkap'];
                $_SESSION['status'] = $user['status'];

                // Arahkan sesuai jenis akun
                if($user['status'] === 'expert'){
                    header("location: expert/dashboard.php");
                    exit();
                } elseif($user['status'] === 'client'){
                    header("location: client/dashboard.php");
                    exit();
                }else{
                    $error1 = "Jenis akun tidak valid.";
                    session_unset();
                }

            } else {
                $error1 = "Username atau password salah.";
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Aspirasi Daerah</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php include 'includes/header.php'; ?>
        <?php include 'includes/navbar.php'; ?>

        <div class="content">
            <h2>Login Pengguna</h2>
            <p>Silakan login untuk masuk ke akun Aspirasi Daerah.</p>

            <div class="form-login">
                <form method="POST" action="login.php">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="text" name="username" placeholder="Masukkan username" value="<?= htmlspecialchars($username) ?>">
                                <br>
                                <span><?= $error['username'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="password" name="password" placeholder="Masukkan password">
                                <br>
                                <span><?= $error['password'] ?? '' ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span><?= $error1 ?></span>
                                <br>
                                <button type="submit" name="login">Login</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <p>Belum memiliki akun?
                    <a href="register.php">Daftar sekarang</a>
                </p>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>

    </body>
</html>
