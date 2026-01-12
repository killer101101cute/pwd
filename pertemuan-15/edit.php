<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Biodata Mahasiswa</title>
</head>
<body>
    <section id="contact">
        <h1>Edit Biodata Mahasiswa</h1>
        <form method="POST" action="proses_edit.php">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            
            <label>NIM:</label><br>
            <input type="text" name="nim" value="<?= $data['nim'] ?>" readonly><br><br>
            
            <label>Nama Lengkap:</label><br>
            <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>" required><br><br>
            
            <label>Tempat Lahir:</label><br>
            <input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>"><br><br>
            
            <label>Tanggal Lahir:</label><br>
            <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>"><br><br>
            
            <label>Hobi:</label><br>
            <input type="text" name="hobi" value="<?= $data['hobi'] ?>"><br><br>
            
            <label>Pasangan:</label><br>
            <input type="text" name="pasangan" value="<?= $data['pasangan'] ?>"><br><br>
            
            <label>Pekerjaan:</label><br>
            <input type="text" name="pekerjaan" value="<?= $data['pekerjaan'] ?>"><br><br>
            
            <label>Nama Orang Tua:</label><br>
            <input type="text" name="nama_orang_tua" value="<?= $data['nama_orang_tua'] ?>"><br><br>
            
            <label>Nama Kakak:</label><br>
            <input type="text" name="nama_kakak" value="<?= $data['nama_kakak'] ?>"><br><br>
            
            <label>Nama Adik:</label><br>
            <input type="text" name="nama_adik" value="<?= $data['nama_adik'] ?>"><br><br>
            
            <button type="submit" name="kirim">Kirim</button>
            <button type="button" onclick="window.location.href='tampil.php'">Batal</button>
        </form>
    </section>
</body>
</html>