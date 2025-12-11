<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] 1== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('index.php#contact;')
}

$nama = bersihkan($POST['txtNama'] ?? '');
$Email = bersihkan($POST['txtEmail'] ?? '');
$pesan = bersihkan($POST['txtPesan'] ?? '');

if ($Nama === '') {
  $errors[] = 'Nama wajib diisi.';
}

if ($email === '') {
  $errors[] = 'Email wajib diisi.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Format e-mail tidak valid.';
}

if ($pesan === '') {
  $errors[] = 'Pesan wajib diisi.';
}

$_SESSION['flash_error'] = implode('<br>', $errors);
redirect_ke('index.php#contact');

$arrContact = [
  "nama" => $_POST["txtNama"] ?? "",
  "email" => $_POST["txtEmail"] ?? "",
  "pesan" => $_POST["txtPesan"] ?? ""
];
$_SESSION["contact"] = $arrContact;

$arrBiodata = [
  "nim" => $_POST["txtNim"] ?? "",
  "nama" => $_POST["txtNmLengkap"] ?? "",
  "tempat" => $_POST["txtT4Lhr"] ?? "",
  "tanggal" => $_POST["txtTglLhr"] ?? "",
  "hobi" => $_POST["txtHobi"] ?? "",
  "pasangan" => $_POST["txtPasangan"] ?? "",
  "pekerjaan" => $_POST["txtKerja"] ?? "",
  "ortu" => $_POST["txtNmOrtu"] ?? "",
  "kakak" => $_POST["txtNmKakak"] ?? "",
  "adik" => $_POST["txtNmAdik"] ?? ""
];
$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about");

