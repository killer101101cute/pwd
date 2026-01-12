<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Biodata Mahasiswa</title>
</head>
<body>
    <section id="biodata">
        <h1>Biodata Sederhana Mahasiswa</h1>
        <form method="POST" action="proses_tambah.php">
            <label>NIM:</label><br>
            <input type="text" name="nim" required><br><br>
            
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_lengkap" required><br><br>
            
            <label>Tempat Lahir:</label><br>
            <input type="text" name="tempat_lahir"><br><br>
            
            <label>Tanggal Lahir:</label><br>
            <input type="date" name="tanggal_lahir"><br><br>
            
            <label>Hobi:</label><br>
            <input type="text" name="hobi"><br><br>
            
            <label>Pasangan:</label><br>
            <input type="text" name="pasangan"><br><br>
            
            <label>Pekerjaan:</label><br>
            <input type="text" name="pekerjaan"><br><br>
            
            <label>Nama Orang Tua:</label><br>
            <input type="text" name="nama_orang_tua"><br><br>
            
            <label>Nama Kakak:</label><br>
            <input type="text" name="nama_kakak"><br><br>
            
            <label>Nama Adik:</label><br>
            <input type="text" name="nama_adik"><br><br>
            
            <button type="submit" name="kirim">Kirim</button>
            <button type="reset">Batal</button>
        </form>
    </section>
</body>
</html>