<?php
session_start();
require_once __DIR__ . '/fungsi.php';

$flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
$flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
$old          = $_SESSION['old'] ?? []; #untuk nilai lama form

unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']); #bersihkan 3 session ini
    
?>

<!DOCTYPE html>
<html lang="en">

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
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>

    <section id="biodata">
      <h2>Biodata Pengunjung</h2>

      <?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
      <?php endif; ?>

      <form action="proses.php" method="POST">

        <label for="txtKodePen"><span>Kode Pengunjung:</span>
          <input type="text" id="txtKodePen" name="txtKodePen" placeholder="Masukkan Kode Pengunjung" required
            value="<?= isset($old['kodepen']) ? htmlspecialchars($old['kodepen']) : '' ?>">
        </label>

        <label for="txtNmPengunjung"><span>Nama Pengunjung:</span>
          <input type="text" id="txtNmPengunjung" name="txtNmPengunjung" placeholder="Masukkan Nama Pengunjung" required
            value="<?= isset($old['nama']) ? htmlspecialchars($old['nama']) : '' ?>">
        </label>

        <label for="txtAlRmh"><span>Alamat Rumah:</span>
          <input type="text" id="txtAlRmh" name="txtAlRmh" placeholder="Masukkan Alamat Rumah" required
            value="<?= isset($old['alamat']) ? htmlspecialchars($old['alamat']) : '' ?>">
        </label>

        <label for="txtTglKunjungan"><span>Tanggal Kunjungan:</span>
          <input type="text" id="txtTglKunjungan" name="txtTglKunjungan" placeholder="Masukkan Tanggal Kunjungan" required
            value="<?= isset($old['tanggal']) ? htmlspecialchars($old['tanggal']) : '' ?>">
        </label>

        <label for="txtHobi"><span>Hobi:</span>
          <input type="text" id="txtHobi" name="txtHobi" placeholder="Masukkan Hobi" required
            value="<?= isset($old['hobi']) ? htmlspecialchars($old['hobi']) : '' ?>">
        </label>

        <label for="txtAsalSMA"><span>Asal SLTA:</span>
          <input type="text" id="txtAsalSMA" name="txtAsalSMA" placeholder="Masukkan Asal SLTA" required
            value="<?= isset($old['slta']) ? htmlspecialchars($old['slta']) : '' ?>">
        </label>

        <label for="txtKerja"><span>Pekerjaan:</span>
          <input type="text" id="txtKerja" name="txtKerja" placeholder="Masukkan Pekerjaan" required
            value="<?= isset($old['pekerjaan']) ? htmlspecialchars($old['pekerjaan']) : '' ?>">
        </label>

        <label for="txtNmOrtu"><span>Nama Orang Tua:</span>
          <input type="text" id="txtNmOrtu" name="txtNmOrtu" placeholder="Masukkan Nama Orang Tua" required
            value="<?= isset($old['ortu']) ? htmlspecialchars($old['ortu']) : '' ?>">
        </label>

        <label for="txtNmPacar"><span>Nama Pacar:</span>
          <input type="text" id="txtNmPacar" name="txtNmPacar" placeholder="Masukkan Nama Pacar" required
            value="<?= isset($old['pacar']) ? htmlspecialchars($old['pacar']) : '' ?>">
        </label>

        <label for="txtNmMantan"><span>Nama Mantan:</span>
          <input type="text" id="txtNmMantan" name="txtNmMantan" placeholder="Masukkan Nama Mantan" required
            value="<?= isset($old['mantan']) ? htmlspecialchars($old['mantan']) : '' ?>">
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>

    <?php
    $biodata = $_SESSION["biodata"] ?? [];

    $fieldConfig = [
      "kodepen" => ["label" => "Kode Pengunjung:", "suffix" => ""],
      "nama" => ["label" => "Nama Pengunjung:", "suffix" => " &#128526;"],
      "alamat" => ["label" => "Alamat Rumah:", "suffix" => ""],
      "tanggal" => ["label" => "Tanggal Kunjungan:", "suffix" => ""],
      "hobi" => ["label" => "Hobi:", "suffix" => " &#127926;"],
      "slta" => ["label" => "Asal SLTA:", "suffix" => " &hearts;"],
      "pekerjaan" => ["label" => "Pekerjaan:", "suffix" => " &copy; 2025"],
      "ortu" => ["label" => "Nama Orang Tua:", "suffix" => ""],
      "pacar" => ["label" => "Nama Pacar:", "suffix" => ""],
      "mantan" => ["label" => "Nama Mantan:", "suffix" => ""],
    ];
    ?>

    <section id="about">
      <h2>Tentang Saya</h2>
      <?= tampilkanBiodata($fieldConfig, $biodata) ?>
    </section>

    

    <section id="contact">
      <h2>Kontak Kami</h2>

      

      <form action="" method="POST">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama"
            autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email"
            required autocomplete="email"
            value="<?= isset($old['email']) ? htmlspecialchars($old['email']) : '' ?>">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..."
            required><?= isset($old['pesan']) ? htmlspecialchars($old['pesan']) : '' ?></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>

        <label for="txtCaptcha"><span>Captcha 2 + 3 = ?</span>
          <input type="number" id="txtCaptcha" name="txtCaptcha" placeholder="Jawab Pertanyaan..."
            required
            value="<?= isset($old['captcha']) ? htmlspecialchars($old['captcha']) : '' ?>">
        </label>

        <button type=" submit">Kirim</button>
          <button type="reset">Batal</button>
      </form>

      <br>
      <hr>
      <h2>Yang menghubungi kami</h2>
      <?php include 'read_inc.php'; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>