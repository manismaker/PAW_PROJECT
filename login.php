<?php

    session_start();

    include "config/koneksi.php";
    include "validasi/validasi_register.php";

    // if(isset($_SESSION['login'])) {
    //     if($_SESSION['status'] === 'expert'){
    //         header("location: expert/dashboard.php");
    //         exit;
    //     } elseif($_SESSION['status'] === 'client'){
    //         header("location: client/dashboard.php");
    //         exit;
    //     }
    // }

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
								<input type="text" name="username" placeholder="Masukkan username">
							</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>
								<input type="password" name="password" placeholder="Masukkan password">
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
                            </td>
                        </tr>
						<tr>
							<td colspan="2">
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