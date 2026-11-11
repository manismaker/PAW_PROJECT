<?php

    $error = [];

    $nama_lengkap = $_POST['nama_lengkap'] ?? '';
    $email = $_POST['email'] ?? '';
    $telepon = $_POST['no_telepon'] ?? '';
    $username = $_POST['username'] ?? '';
    $passwd = $_POST['password'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $role = $_POST['role'] ?? '';

    $pola_lengkap = '/^(?=.{5,20}$)[a-zA-Z]+(?:\.? [a-zA-Z]+|\.[a-zA-Z]+)*\.?$/';
    if(empty($nama_lengkap) || !preg_match($pola_lengkap, $nama_lengkap)){
        $error['lengkap'] = "Nama lengkap tidak valid"; 
    }

    $pola_email = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if(empty($email) || !preg_match($pola_email, $email)){
        $error['mail'] = "Email tidak valid";
    }
    $pola_telepon = '/^(?:\+62|62|0)8[1-9][0-9]{7,10}$/';
    if(empty($telepon) || !preg_match($pola_telepon, $telepon)){
        $error['nomor'] = "No telepon tidak valid";
    }

    $pola_username = '/^[a-zA-Z0-9_]{5,20}$/';
    if(empty($username) || !preg_match($pola_username, $username)){
        $error['nama'] = "Username Tidak valid";
    }

    $pola_passwd = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if(empty($passwd) || !preg_match($pola_passwd, $passwd)){
        $error['passwd'] = "Password tidak valid";

    }
    if(!in_array($role, ['expert', 'client'])){
        $error['role'] = "Role harus di pilih";

    }
    if(empty($alamat)){
        $error['alamat'] = "Alamat harus di isi";

    }
?>