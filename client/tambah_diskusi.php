<?php
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ruang Aspirasi - Tambah Diskusi</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Ruang Aspirasi</h1>
        <p style="margin-top: 5px; color: #a6b9cc; font-size: 0.9rem;">Suara Masyarakat, Perubahan Bersama</p>
    </header>

    <main>
        <div class="form-tambah-diskusi">
            <div class="form-header">
                <h2>Tambah Diskusi Baru</h2>
                <p>Silakan isi form di bawah ini untuk menyampaikan aspirasi.</p>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                
                <!-- Judul Aspirasi -->
                <div class="form-group">
                    <label for="judul">Judul Aspirasi / Diskusi <span class="required">*</span></label>
                    <input type="text" id="judul" name="judul" placeholder="Contoh: Perbaikan Lampu Jalan dan Rambu Lalu Lintas" required>
                </div>

                <!-- Kategori Kebijakan -->
                <div class="form-group">
                    <label for="kategori">Kategori Kebijakan / Topik <span class="required">*</span></label>
                    <select id="kategori" name="kategori" required>
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <option value="infrastruktur">Infrastruktur</option>
                        <option value="pelayanan">Pelayanan Publik</option>
                        <option value="lingkungan">Lingkungan</option>
                    </select>
                </div>

                <!-- Tingkat Urgensi -->
                <div class="form-group">
                    <label>Tingkat Urgensi <span class="required">*</span></label>
                    <div class="radio-inline-group">
                        <label><input type="radio" name="urgensi" value="Biasa" checked> Biasa</label>
                        <label><input type="radio" name="urgensi" value="Penting"> Penting</label>
                        <label><input type="radio" name="urgensi" value="Mendesak"> Mendesak</label>
                    </div>
                </div>

                <!-- Isi Lengkap Diskusi -->
                <div class="form-group">
                    <label for="isi">Isi Lengkap Diskusi / Masalah <span class="required">*</span></label>
                    <textarea id="isi" name="isi" rows="5" placeholder="Jelaskan secara runtut mengenai permasalahan, lokasi, serta solusi yang diusulkan..." required></textarea>
                </div>

                <!-- Upload Lampiran -->
                <div class="form-group">
                    <label for="lampiran">Upload Lampiran (Opsional)</label>
                    <input type="file" id="lampiran" name="lampiran" class="input-file">
                    <small class="file-info">Format file: JPG, PNG, atau PDF (Maks. 5MB)</small>
                </div>

                <!-- Checkbox Anonim -->
                <div class="form-group checkbox-container">
                    <label>
                        <input type="checkbox" name="anonim"> Kirim secara anonim (sembunyikan nama saya)
                    </label>
                </div>

                <!-- Tombol Aksi -->
                <div class="button-actions">
                    <button type="submit" class="tombol btn-kirim">Kirim Diskusi</button>
                    <button type="button" class="tombol btn-batal">Batal</button>
                </div>

            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Ruang Aspirasi</p>
    </footer>

</body>
</html>
