<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM tbl_pengunjung ORDER BY kode DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
  unset($_SESSION['flash_sukses'], $_SESSION['flash_error']); 
?>

<?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Hobi</th>
    <th>Asal SLTA</th>
    <th>Pekerjaan</th>
    <th>Nama Ortu</th>
    <th>Nama Pasangan</th>
    <th>Nama Mantan</th>
    <th>Tanggal Kunjungan</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit.php?kode=<?= (int)$row['kode']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['nama']); ?>?')" href="proses_delete.php?kode=<?= (int)$row['kode']; ?>">Delete</a>
      </td>
      <td><?= $row['kode']; ?></td>
      <td><?= htmlspecialchars($row['nama']); ?></td>
      <td><?= htmlspecialchars($row['alamat']); ?></td>
      <td><?= nl2br(htmlspecialchars($row['hobi'])); ?></td>
      <td><?= nl2br(htmlspecialchars($row['slta'])); ?></td>
      <td><?= nl2br(htmlspecialchars($row['kerja'])); ?></td>
      <td><?= nl2br(htmlspecialchars($row['ortu'])); ?></td>
      <td><?= nl2br(htmlspecialchars($row['pacar'])); ?></td>
      <td><?= nl2br(htmlspecialchars($row['mantan'])); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['tanggal'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>