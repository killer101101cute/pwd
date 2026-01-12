<?php
include 'koneksi.php';

if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $hobi = mysqli_real_escape_string($koneksi, $_POST['hobi']);
    $pasangan = mysqli_real_escape_string($koneksi, $_POST['pasangan']);
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $ortu = mysqli_real_escape_string($koneksi, $_POST['nama_orang_tua']);
    $kakak = mysqli_real_escape_string($koneksi, $_POST['nama_kakak']);
    $adik = mysqli_real_escape_string($koneksi, $_POST['nama_adik']);

    $query = "UPDATE mahasiswa SET 
              nama_lengkap='$nama', 
              tempat_lahir='$tempat_lahir', 
              tanggal_lahir='$tanggal_lahir', 
              hobi='$hobi', 
              pasangan='$pasangan', 
              pekerjaan='$pekerjaan', 
              nama_orang_tua='$ortu', 
              nama_kakak='$kakak', 
              nama_adik='$adik' 
              WHERE id='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampil.php?status=sukses&pesan=Data berhasil diupdate");
    } else {
        header("Location: tampil.php?status=gagal&pesan=Data gagal diupdate");
    }
    exit;
}
?>