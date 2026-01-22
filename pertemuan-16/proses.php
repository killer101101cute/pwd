<?php
session_start();
require __DIR__ . './koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('index.php#biodata');
}

#ambil dan bersihkan nilai dari form
$kodepen  = bersihkan($_POST['txtKodePen']  ?? '');
$nama  = bersihkan($_POST['txtNmPengunjung']  ?? '');
$alamat = bersihkan($_POST['txtAlRmh'] ?? '');
$tanggal = bersihkan($_POST['txtTglKunjungan'] ?? '');
$hobi = bersihkan($_POST['txtHobi'] ?? '');
$slta  = bersihkan($_POST['txtAsalSMA']  ?? '');
$pekerjaan  = bersihkan($_POST['txtKerja']  ?? '');
$ortu = bersihkan($_POST['txtNmOrtu'] ?? '');
$pacar = bersihkan($_POST['txtNmPacar'] ?? '');
$mantan = bersihkan($_POST['txtNmMantan'] ?? '');


#Validasi sederhana
$errors = []; #ini array untuk menampung semua error yang ada

if ($kodepen === '') {
  $errors[] = 'Kode Pengunjung wajib diisi.';
}

if ($nama === '') {
  $errors[] = 'Nama Pengunjung wajib diisi.';
}

if ($alamat === '') {
  $errors[] = 'Alamat Pengunjung wajib diisi.';
} 

if ($tanggal === '') {
  $errors[] = 'Tanggal Kunjungan wajib diisi.';
}

if ($hobi === '') {
  $errors[] = 'Hobi wajib diisi.';
}

if ($slta === '') {
  $errors[] = 'Asal SLTA wajib diisi.';
}

if ($pekerjaan === '') {
  $errors[] = 'Pekerjaan wajib diisi.';
}

if ($ortu === '') {
  $errors[] = 'Nama Orangtua wajib diisi.';
} 

if ($pacar === '') {
  $errors[] = 'Nama Pacar wajib diisi.';
}

if ($mantan === '') {
  $errors[] = 'Nama Mantan wajib diisi.';
}

if (mb_strlen($nama) < 3) {
  $errors[] = 'Nama minimal 3 karakter.';
}

if (mb_strlen($tanggal) < 10) {
  $errors[] = 'tanggal minimal 10 karakter.';
}


/*
kondisi di bawah ini hanya dikerjakan jika ada error, 
simpan nilai lama dan tanggal error, lalu redirect (konsep PRG)
*/
if (!empty($errors)) {
  $_SESSION['old'] = [
    'kodepen'  => $kodepen,
    'nama'  => $nama,
    'alamat' => $alamat,
    'tanggal' => $tanggal,
    'hobi' => $hobi,
    'slta'  => $slta,
    'pekerjaan'  => $pekerjaan,
    'ortu' => $ortu,
    'pacar' => $pacar,
    'mantan' => $mantan,
  ];
  $_SESSION['flash_error'] = implode('<br>', $errors);
  redirect_ke('index.php#biodata');
}

#menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_pengunjung (kode, nama, alamat, tanggal, hobi, slta, kerja, ortu, pacar, mantan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim tanggal error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#biodata');
}
#bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param($stmt, "ssssssssss", $kode, $nama, $alamat, $tanggal, $hobi, $slta, $kerja, $ortu, $pacar, $mantan);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value, beri tanggal sukses
  unset($_SESSION['old']);
  $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah tersimpan.';
  redirect_ke('index.php#biodata'); #pola PRG: kembali ke form / halaman home
} else { #jika gagal, simpan kembali old value dan tampilkan error umum
  $_SESSION['old'] = [
    'kodepen'  => $kodepen,
    'nama'  => $nama,
    'alamat' => $alamat,
    'tanggal' => $tanggal,
    'hobi' => $hobi,
    'slta'  => $slta,
    'pekerjaan'  => $pekerjaan,
    'ortu' => $ortu,
    'pacar' => $pacar,
    'mantan' => $mantan,
  ];
  $_SESSION['flash_error'] = 'Data gagal disimpan. Silakan coba lagi.';
  redirect_ke('index.php#biodata');
}
#tutup statement
mysqli_stmt_close($stmt);
/* 
$arrBiodata = [
  "kodepen" => $_POST["txtKodePen"] ?? "",
  "nama" => $_POST["txtNmPengunjung"] ?? "",
  "alamat" => $_POST["txtAlRmh"] ?? "",
  "tanggal" => $_POST["txtTglKunjungan"] ?? "",
  "hobi" => $_POST["txtHobi"] ?? "",
  "slta" => $_POST["txtAsalSMA"] ?? "",
  "pekerjaan" => $_POST["txtKerja"] ?? "",
  "ortu" => $_POST["txtNmOrtu"] ?? "",
  "pacar" => $_POST["txtNmPacar"] ?? "",
  "mantan" => $_POST["txtNmMantan"] ?? ""
];
$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about"); */
