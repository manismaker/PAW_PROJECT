<?php
    require __DIR__ . "/../config/koneksi.php";

    function nama_lengkap(&$errors, $field_list, $field_name){
        $pola = "/^[a-zA-Z\s]+$/";

        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Nama lengkap harus diisi";
        }else if(!preg_match($pola, $field_list[$field_name])){
            $errors[$field_name] = "Nama lengkap hanya boleh berisi huruf";
        }else if(strlen($field_list[$field_name]) < 6 || strlen($field_list[$field_name]) > 100){
            $errors[$field_name] = "Nama lengkap harus terdiri dari 6-100 karakter";
        }
    }

    function email(&$errors, $field_list, $field_name){
        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Email harus diisi";
        }else if(!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL)){
            $errors[$field_name] = "Format email tidak valid";
        }
    }

    function no_telepon(&$errors, $field_list, $field_name){
        $pola = "/^[0-9]+$/";

        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Nomor telepon harus diisi";
        }else if(!preg_match($pola, $field_list[$field_name])){
            $errors[$field_name] = "Nomor telepon hanya boleh berisi angka";
        }else if(strlen($field_list[$field_name]) < 10 || strlen($field_list[$field_name]) > 13){
            $errors[$field_name] = "Nomor telepon harus terdiri dari 10-13 digit";
        }
    }

    function username(&$errors, $field_list, $field_name){
        $pola = "/^[a-zA-Z0-9_]+$/";

        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Username harus diisi";
        }else if(!preg_match($pola, $field_list[$field_name])){
            $errors[$field_name] = "Username hanya boleh berisi huruf, angka, dan underscore";
        }else if(strlen($field_list[$field_name]) < 5 || strlen($field_list[$field_name]) > 20){
            $errors[$field_name] = "Username harus terdiri dari 5-20 karakter";
        }
    }

    function password(&$errors, $field_list, $field_name){
        $pola = "/^[a-zA-Z0-9]+$/";

        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Password harus diisi";
        }else if(!preg_match($pola, $field_list[$field_name])){
            $errors[$field_name] = "Password hanya boleh berisi huruf dan angka";
        }else if(strlen($field_list[$field_name]) < 8){
            $errors[$field_name] = "Password minimal terdiri dari 8 karakter";
        }
    }

    function role(&$errors, $field_list, $field_name){
        if(!isset($field_list[$field_name]) || !in_array($field_list[$field_name], ['expert', 'client'])){
            $errors[$field_name] = "Silakan pilih jenis akun";
        }
    }

    function alamat(&$errors, $field_list, $field_name){
        if(!isset($field_list[$field_name]) || empty($field_list[$field_name])){
            $errors[$field_name] = "Alamat harus diisi";
        }
    }

    function selectAll() {
        global $dbc;
        $statement = "SELECT * FROM user";
        $result = $dbc->query($statement);

        $rows = [];
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    function selectAllrespon() {
        global $dbc;
        $statement = "SELECT respon.*, user.nama FROM respon JOIN user ON respon.id_user = user.id_user ";
        $result = $dbc->query($statement);

        $rows = [];
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    // fungsi JOIN agar nama_topik dan nama user ikut terambil
    function selectAlldiskusi() {
    global $dbc;
    $statement = "SELECT diskusi.*, topik.*, user.* 
                  FROM diskusi 
                  JOIN topik ON diskusi.id_topik = topik.id_topik
                  JOIN user ON diskusi.id_user = user.id_user";
    
    $result = $dbc->query($statement);

    $rows = [];
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

//Fungsi untuk mengambil daftar topik/kategori
function getTopik() {
    global $dbc;
    $statement = "SELECT * FROM topik";
    $result = $dbc->query($statement);

    $rows = [];
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
    }
    return $rows;
}

// Fungsi untuk mengambil data user
function getUser() {
    global $dbc;
    $statement = "SELECT * FROM user";
    $result = $dbc->query($statement);

    $rows = [];
    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
    }
    return $rows;
}
//fungsi nambahin diskusi
function tambah_diskusi($judul, $isi_aspirasi, $id_topik,$id_user){
    global $dbc;
    $statement = $dbc->prepare("INSERT INTO diskusi (judul, isi_aspirasi, id_topik, id_user, tanggal) 
                            VALUES (:judul, :isi_aspirasi, :id_topik, :id_user, NOW())");
    $satement->bindValue(':judul', $judul);
    $satement->bindValue(':isi_aspirasi', $isi_aspirasi);
    $satement->bindValue(':id_topik', $id_topik);
    $satement->bindValue(':id_user', $id_user);

    return $statement->execute();
}

function tambah_respon($isi_respon, $id_diskusi, $id_user){
    global $dbc;
    $statement = $dbc->prepare("INSERT INTO respon (isi_respon, id_diskusi, id_user, tgl_respon) VALUES (:isi_respon, :id_diskusi, :id_user, NOW())");

    $statement->bindValue(':isi_respon', $isi_respon);
    $statement->bindValue(':id_diskusi', $id_diskusi);
    $statement->bindValue(':id_user', $id_user);

    $result = $statement->execute();

    return $result;
}

function update_respon($isi_respon, $id_diskusi, $id_user){
    global $dbc;
    $statement = $dbc->prepare("UPDATE respon SET isi_respon = :isi_respon, id_diskusi = :id_diskusi, id_user = :id_user, tgl_respon = NOW())");

    $statement->bindValue(':isi_respon', $isi_respon);
    $statement->bindValue(':id_diskusi', $id_diskusi);
    $statement->bindValue(':id_user', $id_user);

    $result = $statement->execute();

    return $result;
}

function update_profil($id_user, $nama_lengkap, $username, $email, $no_telepon, $alamat){
    global $dbc;
    $statement = $dbc->prepare("UPDATE user SET nama_lengkap = :nama_lengkap, nama = :username, email = :email, no_telepon = :no_telepon, alamat = :alamat WHERE id_user = :id_user");
    $statement->bindValue(':nama_lengkap', $nama_lengkap);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':no_telepon', $no_telepon);
    $statement->bindValue(':alamat', $alamat);
    $statement->bindValue(':id_user', $id_user);

    header("Location: profil.php?status=sukses");
    return $statement->execute();
}

// Fungsi untuk menampilkan diskusi milik user yang sedang login saja
function getDiskusiByUser($id_user) {
    global $dbc;
    $statement = $dbc->prepare("SELECT diskusi.*, topik.nama_topik 
                                FROM diskusi 
                                JOIN topik ON diskusi.id_topik = topik.id_topik 
                                WHERE diskusi.id_user = :id_user");
    $statement->execute(['id_user' => $id_user]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function validateTanggapan($error, $tanggapan){
    if(!isset($tanggapan) || empty(trim($tanggapan))){
        $error['isi_respon'] = "Tanggapan harus diisi";
}
}

?>
