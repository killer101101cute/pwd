<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  /*
    Ambil nilai kode dari GET dan lakukan validasi untuk 
    mengecek kode harus angka dan lebih besar dari 0 (> 0).
    'options' => ['min_range' => 1] artinya kode harus ≥ 1 
    (bukan 0, bahkan bukan negatif, bukan huruf, bukan HTML).
  */
  /* $kode = filter_input(INPUT_GET, 'kode', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]); */
  $kode = filter_input(INPUT_GET, 'kode', FILTER_SANITIZE_STRING);
  /*
    Skrip di atas cara penulisan lamanya adalah:
    $kode = $_GET['kode'] ?? '';
    $kode = (int)$kode;

    Cara lama seperti di atas akan mengambil data mentah 
    kemudian validasi dilakukan secara terpisah, sehingga 
    rawan lupa validasi. Untuk input dari GET atau POST, 
    filter_input() lebih disarankan daripada $_GET atau $_POST.
  */

  /*
    Cek apakah $kode bernilai valid:
    Kalau $kode tidak valid, maka jangan lanjutkan proses, 
    kembalikan pengguna ke halaman awal (read.php) sembari 
    mengirim penanda error.
  */
  if (!$kode) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read.php');
  }

  /*
    Ambil data lama dari DB menggunakan prepared statement, 
    jika ada kesalahan, tampilkan penanda error.
  */
  $stmt = mysqli_prepare($conn, "SELECT * 
                                    FROM tbl_pengunjung WHERE kode = ? LIMIT 1");
  if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read.php');
  }

  mysqli_stmt_bind_param($stmt, "s", $kode);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($res);
  mysqli_stmt_close($stmt);

  if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('read.php');
  }

  #Nilai awal (prefill form)
  $kodepen  = $row['kode'] ?? '';
  $nama  = $row['nama'] ?? '';
  $alamat = $row['alamat'] ?? '';
  $hobi = $row['hobi'] ?? '';
  $slta = $row['slta'] ?? '';
  $pekerjaan  = $row['kerja'] ?? '';
  $ortu  = $row['ortu'] ?? '';
  $pacar = $row['pacar'] ?? '';
  $mantan = $row['mantan'] ?? '';
  $tanggal = $row['tanggal'] ?? '';

  #Ambil error dan nilai old input kalau ada
  $flash_error = $_SESSION['flash_error'] ?? '';
  $old = $_SESSION['old'] ?? [];
  unset($_SESSION['flash_error'], $_SESSION['old']);
  if (!empty($old)) {
    $kodepen  = $old['kodepen'] ?? $kodepen;
    $nama = $old['nama'] ?? $nama;
    $alamat = $old['alamat'] ?? $alamat;
    $tanggal  = $old['tanggal'] ?? $tanggal;
    $hobi = $old['hobi'] ?? $hobi;
    $slta = $old['slta'] ?? $slta;
    $pekerjaan  = $old['pekerjaan'] ?? $pekerjaan;
    $ortu = $old['ortu'] ?? $ortu;
    $pacar = $old['pacar'] ?? $pacar;
    $mantan = $old['mantan'] ?? $mantan;
  }
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1>Ini Header</h1>
      <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
        &#9776;
      </button>
      <nav>
        <ul>
          <li><a href="#home">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="contact">
        <h2>Edit Buku Tamu</h2>
        <?php if (!empty($flash_error)): ?>
          <div style="padding:10px; margin-bottom:10px; 
            background:#f8d7da; color:#721c24; border-radius:6px;">
            <?= $flash_error; ?>
          </div>
        <?php endif; ?>
        <form action="proses_update.php" method="POST">

          <input type="text" name="kode" value="<?= $kode; ?>">

          
          <label for="txtKodePen"><span>Kode Pengunjung:</span>
            <input disabled readonly type="text" id="txtKodePen" name="txtKodePen" placeholder="Masukkan Kode Pengunjung" required
              value="<?= !empty($kodepen) ? $kodepen : '' ?>">
          </label>

          <label for="txtNmPengunjung"><span>Nama Pengunjung:</span>
            <input type="text" id="txtNmPengunjung" name="txtNmPengunjung" placeholder="Masukkan Nama Pengunjung" required
              value="<?= !empty($nama) ? $nama : '' ?>">
          </label>

          <label for="txtAlRmh"><span>Alamat Rumah:</span>
            <input type="text" id="txtAlRmh" name="txtAlRmh" placeholder="Masukkan Alamat Rumah" required
              value="<?= !empty($alamat) ? $alamat : '' ?>">
          </label>

          <label for="txtTglKunjungan"><span>Tanggal Kunjungan:</span>
            <input type="text" id="txtTglKunjungan" name="txtTglKunjungan" placeholder="Masukkan Tanggal Kunjungan" required
              value="<?= !empty($tanggal) ? $tanggal : '' ?>">
          </label>

          <label for="txtHobi"><span>Hobi:</span>
            <input type="text" id="txtHobi" name="txtHobi" placeholder="Masukkan Hobi" required
              value="<?= !empty($hobi) ? $hobi : '' ?>">
          </label>

          <label for="txtAsalSMA"><span>Asal SLTA:</span>
            <input type="text" id="txtAsalSMA" name="txtAsalSMA" placeholder="Masukkan Asal SLTA" required
              value="<?= !empty($slta) ? $slta : '' ?>">
          </label>

          <label for="txtKerja"><span>Pekerjaan:</span>
            <input type="text" id="txtKerja" name="txtKerja" placeholder="Masukkan Pekerjaan" required
              value="<?= !empty($pekerjaan) ? $pekerjaan : '' ?>">
          </label>

          <label for="txtNmOrtu"><span>Nama Orang Tua:</span>
            <input type="text" id="txtNmOrtu" name="txtNmOrtu" placeholder="Masukkan Nama Orang Tua" required
              value="<?= !empty($ortu) ? $ortu : '' ?>">
          </label>

          <label for="txtNmPacar"><span>Nama Pacar:</span>
            <input type="text" id="txtNmPacar" name="txtNmPacar" placeholder="Masukkan Nama Pacar" required
              value="<?= !empty($pacar) ? $pacar : '' ?>">
          </label>

          <label for="txtNmMantan"><span>Nama Mantan:</span>
            <input type="text" id="txtNmMantan" name="txtNmMantan" placeholder="Masukkan Nama Mantan" required
              value="<?= !empty($mantan) ? $mantan : '' ?>">
          </label>

          <button type="submit">Kirim</button>
          <button type="reset">Batal</button>
          <a href="read.php" class="reset">Kembali</a>
        </form>
      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>