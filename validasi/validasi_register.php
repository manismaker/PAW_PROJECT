<?php

    function nama_lengkap(&$error, $nama_lengkap){
        if(empty($nama_lengkap) || is_numeric($nama_lengkap) || strlen($nama_lengkap) <= 5 || strlen($nama_lengkap) > 20){
            $error['lengkap'] = "Nama lengkap tidak valid"; 
        }
    }

    function email(&$error, $email){
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['mail'] = "Email tidak valid";
        }
    }

    function no_telepon(&$error, $telepon){
        $pola_telepon = '/^(?:62|0)8[1-9][0-9]$/';
        if(empty($telepon) || !preg_match($pola_telepon, $telepon) || strlen($telepon) < 10 || strlen($telepon) > 13){
            $error['nomor'] = "No telepon tidak valid";
        }
    }

    function username(&$error, $username){
        $pola_username = '/^[a-zA-Z0-9_]+$/';
        if(empty($username) || !preg_match($pola_username, $username) || strlen($username) < 5 || strlen($username) > 20){
            $error['nama'] = "Username Tidak valid";
        }
    }  

    function password(&$error, $passwd){
        $pola_passwd = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        if(empty($passwd) || !preg_match($pola_passwd, $passwd) || strlen($passwd) < 8 || strlen($passwd) > 20){
            $error['passwd'] = "Password tidak valid";

        }
    }  
    
    function role(&$error, $role){
        if(!in_array($role, ['expert', 'client'])){
            $error['role'] = "Role harus di pilih";

        }
    }

    function alamat(&$error, $alamat){
        if(empty($alamat)){
            $error['alamat'] = "Alamat harus di isi";

        }
    }
?>