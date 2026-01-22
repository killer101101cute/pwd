<?php
  session_start();
  require __DIR__ . '/koneksi.php';
  require_once __DIR__ . '/fungsi.php';

  #cek method form, hanya izinkan POST
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read.php');
  }

  #validasi kode wajib angka dan > 0
  /* $kode = filter_input(INPUT_POST, 'kode', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
  ]); */
  $kode = filter_input(INPUT_POST, 'kode', FILTER_SANITIZE_STRING);


  if (!$kode) {
    $_SESSION['flash_error'] = 'kode Tidak Valid.';
    redirect_ke('edit.php?kode='. $kode);
  }

  
  #ambil dan bersihkan (sanitasi) nilai dari form
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
  simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
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
    redirect_ke('edit.php?kode='. $kode);
  }

  /*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE kode = ?)
  */
  $stmt = mysqli_prepare($conn, "UPDATE tbl_pengunjung 
                                SET nama = ?, alamat = ?, tanggal = ?, hobi = ?, slta = ?, kerja = ?, ortu = ?, pacar = ?, mantan = ?
                                WHERE kode = ?");
  if (!$stmt) {
    #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
    $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
    redirect_ke('edit.php?kode='. $kode);
  }

  #bind parameter dan eksekusi (s = string, i = integer)
  mysqli_stmt_bind_param($stmt, "ssssssssss", $nama, $alamat, $tanggal, $hobi, $slta, $pekerjaan, $ortu, $pacar, $mantan, $kode);

  if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
    unset($_SESSION['old']);
    /*
      Redirect balik ke read.php dan tampilkan info sukses.
    */
    $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah diperbaharui.';
    redirect_ke('read.php'); #pola PRG: kembali ke data dan exit()
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
    $_SESSION['flash_error'] = 'Data gagal diperbaharui. Silakan coba lagi.';
    redirect_ke('edit.php?kode='. $kode);
  }
  #tutup statement
  mysqli_stmt_close($stmt);

  redirect_ke('edit.php?kode='. $kode);