<?php
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

?>
