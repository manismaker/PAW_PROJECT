<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aspirasi Daerah - Tambah Diskusi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Aspirasi Daerah</h1>
        <p>Suara Masyarakat, Perubahan Bersama</p>
    </header>

    <main>
        <div class="form-tambah-diskusi">
            <div class="form-header">
                <h2>Tambah Diskusi Baru</h2>
                <p>Silakan isi form di bawah ini untuk menyampaikan aspirasi.</p>
            </div>

            <form action="" method="POST" >
                <div class="form-group">
                    <label for="judul">Judul Aspirasi / Diskusi</label>
                    <input type="text" id="judul" name="judul" placeholder="Contoh: Perbaikan Lampu Jalan dan Rambu Lalu Lintas">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Kebijakan / Topik</label>
                    <select id="kategori" name="kategori">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <option value="infrastruktur">Infrastruktur</option>
                        <option value="pelayanan">Pelayanan Publik</option>
                        <option value="lingkungan">Lingkungan</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi Lengkap Diskusi / Masalah </label>
                    <textarea id="isi" name="isi" rows="5" placeholder="Jelaskan secara runtut mengenai permasalahan, lokasi, serta solusi yang diusulkan..."></textarea>
                </div>

                <div class="button-actions">
                    <button type="submit" class="tombol btn-kirim">Kirim Diskusi</button>
                    <button type="button" class="tombol btn-batal">Batal</button>
                </div>

            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Aspirasi Daerah</p>
    </footer>

</body>
</html>
