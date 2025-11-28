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

    <section id="about">
      <?php
      $nim = 2511500010;
      $NIM = '0344300002';
      $nama = "Say'yid Abdullah";
      $Nama = 'Al\'kautar Benyamin';
      $tempatlahir = "Jebus";
      $tanggallahir = "13 April 2004";
      $hobi = "Bergulat, Sumo, Makan, Pajo";
      ?>
      <h2>Tentang Saya</h2>
      <p><strong>NIM:</strong>
        <?php
        echo $NIM;
        ?>
      </p>
      <p><strong>Nama Lengkap:</strong>
        <?php
        echo $Nama;
        ?> &#128526;
      </p>
      <p><strong>Tempat Lahir:</strong> <?php echo $tempatlahir ?></p>
      <p><strong>Tanggal Lahir:</strong> <?php echo $tanggallahir ?></p>
      <p><strong>Hobi:</strong> <?php echo $hobi ?> &#127926;</p>
      <p><strong>Pasangan:</strong> Belum ada &hearts;</p>
      <p><strong>Pekerjaan:</strong> Dosen di ISB Atma Luhur &copy; 2025</p>
      <p><strong>Nama Orang Tua:</strong> Bapak Setiawan dan Ibu Maria</p>
      <p><strong>Nama Kakak:</strong> Antonius Setiawan</p>
      <p><strong>Nama Adik:</strong> Christina Setiawan</p>
    </section>

    <section id="ipk">
      <?php
      $namaMatkul1 = "Algoritma dan Struktur Data";
      $namaMatkul2 = "";
      $namaMatkul3 = "";
      $namaMatkul4 = "";
      $namaMatkul5 = "";
      $sksMatkul1 = 4;
      $sksMatkul2 = "";
      $sksMatkul3 = "";
      $sksMatkul4 = "";
      $sksMatkul5 = "";
      $nilaiHadir1 = 90;
      $nilaiHadir2 = "";
      $nilaiHadir3 = "";
      $nilaiHadir4 = "";
      $nilaiHadir5 = "";
      $nilaiTugas1 = 60;
      $nilaiTugas2 = "";
      $nilaiTugas3 = "";
      $nilaiTugas4 = "";
      $nilaiTugas5 = "";
      $nilaiUTS1 = "";
      $nilaiUTS2 = "";
      $nilaiUTS3 = "";
      $nilaiUTS4 = "";
      $nilaiUTS5 = "";
      $nilaiUAS1 = "";
      $nilaiUAS2 = "";
      $nilaiUAS3 = "";
      $nilaiUAS4 = "";
      $nilaiUAS5 = "";
      #Nilai Akhir = (0.1 * nilaiHadir) + (0.2 * nilaiTugas) + (0.3 * nilaiUTS) + (0.4 * nilaiUAS)
      $nilaiAkhir1 = (0.1 * $nilaiHadir1) + (0.2 * $nilaiTugas1) + (0.3 * $nilaiUTS1) + (0.4 * $nilaiUAS1);
      $nilaiAkhir2 = (0.1 * $nilaiHadir2) + (0.2 * $nilaiTugas2) + (0.3 * $nilaiUTS2) + (0.4 * $nilaiUAS2);
      $nilaiAkhir3 = (0.1 * $nilaiHadir3) + (0.2 * $nilaiTugas3) + (0.3 * $nilaiUTS3) + (0.4 * $nilaiUAS3);
      $nilaiAkhir4 = (0.1 * $nilaiHadir4) + (0.2 * $nilaiTugas4) + (0.3 * $nilaiUTS4) + (0.4 * $nilaiUAS4);
      $nilaiAkhir5 = (0.1 * $nilaiHadir5) + (0.2 * $nilaiTugas5) + (0.3 * $nilaiUTS5) + (0.4 * $nilaiUAS5);
      
      if (($nilaiAkhir1>=91) && ($nilaiAkhir1<=100)):
        $grade1 = "A";
        $mutu1 = 4;
      elseif (($nilaiAkhir1>=81) && ($nilaiAkhir1<=90)):
        $grade1 = "A-";
        $mutu1 = 3.7;
      endif;

      if (($nilaiAkhir2 >= 91) && ($nilaiAkhir2 <= 100)):
        $grade2 = "A";
        $mutu2 = 4;
      elseif (($nilaiAkhir2 >= 81) && ($nilaiAkhir2 <= 90)):
        $grade2 = "A-";
        $mutu2 = 3.7;
      endif;
      
      #Nilai kehadiran < 70, otomatis Grade = E.
      if ($nilaiHadir1 < 70):
        $grade1 = "E";
      endif;
      if ($nilaiHadir2 < 70):
        $grade2 = "E";
      endif;
      if ($nilaiHadir3 < 70):
        $grade3 = "E";
      endif;
      if ($nilaiHadir4 < 70):
        $grade4 = "E";
      endif;
      if ($nilaiHadir5 < 70):
        $grade5 = "E";
      endif;



      #Bobot = angkaMutu * sksMatkul
      
      $bobot1 = $mutu1 * $sksMatkul1;
      $bobot2 = $mutu2 * $sksMatkul2;
      $bobot3 = $mutu3 * $sksMatkul3;
      $bobot4 = $mutu4 * $sksMatkul4;
      $bobot5 = $mutu5 * $sksMatkul5;

      /*
      Grade A, A-, B+, B, B-, C+, C, C- maka Status: LULUS
      Grade D, E maka Status: GAGAL
      */
      switch ($grade1):
        case "A": $status1 = "LULUS"; break;
        case "A-": $status1 = "LULUS"; break;
        case "B+": $status1 = "LULUS"; break;
        case "B": $status1 = "LULUS"; break;
        case "B-": $status1 = "LULUS"; break;
        case "C+": $status1 = "LULUS"; break;
        case "C": $status1 = "LULUS"; break;
        case "C-": $status1 = "LULUS"; break;
        case "D":
        case "E":
          $status1 = "GAGAL";
          break;
      endswitch;

      switch ($grade2):
        case "A":
          $status2 = "LULUS";
          break;
        case "A-":
          $status2 = "LULUS";
          break;
        case "B+":
          $status2 = "LULUS";
          break;
        case "B":
          $status2 = "LULUS";
          break;
        case "B-":
          $status2 = "LULUS";
          break;
        case "C+":
          $status2 = "LULUS";
          break;
        case "C":
          $status2 = "LULUS";
          break;
        case "C-":
          $status2 = "LULUS";
          break;
        case "D":
        case "E":
          $status2 = "GAGAL";
          break;
      endswitch;

      switch ($grade3):
        case "A":
          $status3 = "LULUS";
          break;
        case "A-":
          $status3 = "LULUS";
          break;
        case "B+":
          $status3 = "LULUS";
          break;
        case "B":
          $status3 = "LULUS";
          break;
        case "B-":
          $status3 = "LULUS";
          break;
        case "C+":
          $status3 = "LULUS";
          break;
        case "C":
          $status3 = "LULUS";
          break;
        case "C-":
          $status3 = "LULUS";
          break;
        case "D":
        case "E":
          $status3 = "GAGAL";
          break;
      endswitch;

      switch ($grade4):
        case "A":
          $status4 = "LULUS";
          break;
        case "A-":
          $status4 = "LULUS";
          break;
        case "B+":
          $status4 = "LULUS";
          break;
        case "B":
          $status4 = "LULUS";
          break;
        case "B-":
          $status4 = "LULUS";
          break;
        case "C+":
          $status4 = "LULUS";
          break;
        case "C":
          $status4 = "LULUS";
          break;
        case "C-":
          $status4 = "LULUS";
          break;
        case "D":
        case "E":
          $status4 = "GAGAL";
          break;
      endswitch;

      switch ($grade5):
        case "A":
          $status5 = "LULUS";
          break;
        case "A-":
          $status5 = "LULUS";
          break;
        case "B+":
          $status5 = "LULUS";
          break;
        case "B":
          $status5 = "LULUS";
          break;
        case "B-":
          $status5 = "LULUS";
          break;
        case "C+":
          $status5 = "LULUS";
          break;
        case "C":
          $status5 = "LULUS";
          break;
        case "C-":
          $status5 = "LULUS";
          break;
        case "D":
        case "E":
          $status5 = "GAGAL";
          break;
      endswitch;

      $totalBobot = $bobot1 + $bobot2 + $bobot3 + $bobot4 + $bobot5;
      $totalSKS = $sksMatkul1 + $sksMatkul2 + $sksMatkul3 + $sksMatkul4 + $sksMatkul5;

      #IPK = totalBobot / totalSKS

      $IPK = $totalBobot / $totalSKS;

      ?>
      <h2>Nilai Saya</h2>

      <p><strong>Nama Matakuliah ke-1:</strong> <?php echo $namaMatkul1 ?></p>
      <p><strong>SKS:</strong> <?php echo $sksMatkul1 ?></p>
      <p><strong>Kehadiran:</strong> <?php echo $nilaiHadir1 ?></p>
      <p><strong>Tugas:</strong> <?php echo $nilaiTugas1 ?></p>
      
UTS : 80 => $nilaiUTS1
UAS : 70 => $nilaiUAS1
Nilai Akhir : 73 => $nilaiAkhir1
Grade : B => $grade1
Angka Mutu : 3.00 => $mutu1
Bobot : 12 => $bobot1
Status : Lulus => $status1

    </section>

    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="" method="GET">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>