<?php
include 'koneksi.php';

if (isset($_POST['kirim'])) {
    // Sanitasi data
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

    // Validasi NIM unik
    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    if (mysqli_num_rows($cek) > 0) {
        header("Location: tambah.php?status=gagal&pesan=NIM sudah terdaftar");
        exit;
    }

    // Insert data
    $query = "INSERT INTO mahasiswa (nim, nama_lengkap, tempat_lahir, tanggal_lahir, hobi, pasangan, pekerjaan, nama_orang_tua, nama_kakak, nama_adik) 
              VALUES ('$nim', '$nama', '$tempat_lahir', '$tanggal_lahir', '$hobi', '$pasangan', '$pekerjaan', '$ortu', '$kakak', '$adik')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampil.php?status=sukses&pesan=Data berhasil disimpan");
    } else {
        header("Location: tampil.php?status=gagal&pesan=Data gagal disimpan");
    }
    exit;
}
?>