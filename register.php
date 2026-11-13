<?php

    session_start();

    include "config/koneksi.php";
    include "validasi/validasi_register.php";

    if(isset($_SESSION['login'])) {
        if($_SESSION['status'] === 'expert'){
            header("location: expert/dashboard.php");
            exit();
        } elseif($_SESSION['status'] === 'client'){
            header("location: client/dashboard.php");
            exit();
        }
    }

    $error1 = "";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nama_lengkap = $_POST['nama_lengkap'] ?? '';
        $email = $_POST['email'] ?? '';
        $telepon = $_POST['no_telepon'] ?? '';
        $username = $_POST['username'] ?? '';
        $passwd = $_POST['password'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $role = $_POST['role'] ?? '';
        
        $error = [];
        nama_lengkap($error, $nama_lengkap);
        email($error, $email);
        no_telepon($error, $telepon);
        username($error, $username);
        password($error, $passwd);
        role($error, $role);
        alamat($error, $alamat);

        if(!empty($error)){
            $error1 = "Daftar gagal, input dengan benar";
        }else{
            $hashPW = hash('sha256', $passwd);
            
            try{
                $statement = $dbc->prepare("INSERT INTO user (nama, email, password, status, alamat, no_telepon, nama_lengkap) VALUES (:nama, :email, :password, :status, :alamat, :no_telepon, :nama_lengkap)");
                $statement->bindValue(':nama_lengkap', $nama_lengkap);
                $statement->bindValue(':nama', $username);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':no_telepon', $telepon);
                $statement->bindValue(':password', $hashPW);
                $statement->bindValue(':status', $role);
                $statement->bindValue(':alamat', $alamat);

                $statement->execute();
                header("location: login.php");
                exit; 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Aspirasi Daerah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="content">
    <h2>Daftar Akun</h2>
    <p>Buat akun untuk bergabung dalam forum Aspirasi Daerah.</p>

    <div class="form-daftar">
        <form method="POST" action="register.php">
            <table>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap">
                        <span><?= $error['lengkap'] ?? '' ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Buat username">
                        <br>
                        <span><?= $error['nama'] ?? '' ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" placeholder="Masukkan email">
                        <br>
                        <span><?= $error['mail'] ?? '' ?></span>
                    </td>
                </tr>

				<tr>
					<td>Nomor Telepon</td>
					<td>
						<input type="text" name="no_telepon" placeholder="Masukkan nomor telepon">
                        <br>
                        <span><?= $error['nomor'] ?? '' ?></span>
					</td>
				</tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Buat password">
                        <br>
                        <span><?= $error['passwd'] ?? '' ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>
                        <textarea name="alamat" placeholder="Masukkan alamat"></textarea>
                        <br>
                        <span><?= $error['alamat'] ?? '' ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Akun</td>
                    <td>
                        <select name="role">
                            <option value="">Pilih jenis akun</option>
                            <option value="client">Client</option>
                            <option value="expert">Expert</option>
                        </select>
                        <br>
                        <span><?= $error['role'] ?? '' ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="daftar">Daftar</button>
                    </td>
                </tr>
            </table>
        </form>

        <p>Sudah memiliki akun?
            <a href="login.php">Login sekarang</a>
        </p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>