<?php
session_start();

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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $pesan = $_POST["pesan"];

    // Validasi nama
    if (strlen($nama) < 3) {
        echo "Nama harus minimal 3 karakter.";
    }

    // Validasi pesan
    if (strlen($pesan) < 10) {
        echo "Pesan harus minimal 10 karakter.";
    }

    // Jika validasi berhasil, lanjutkan proses penyimpanan data
    if (strlen($nama) >= 3 && strlen($pesan) >= 10) {
        // Kode untuk menyimpan data ke database
    }
}
?>

