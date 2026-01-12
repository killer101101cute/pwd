<?php
include 'koneksi.php';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tampil Biodata Mahasiswa</title>
</head>
<body>
    <h1>Daftar Biodata Mahasiswa</h1>
    <!-- Tampilkan status sukses/gagal -->
    <?php if ($status): ?>
        <p style="color: <?= $status == 'sukses' ? 'green' : 'red' ?>;"><?= $pesan ?></p>
    <?php endif; ?>
    
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>NIM</th>
            <th>Nama Lengkap</th>
            <th>Tempat Lahir</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM mahasiswa";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['nim'] ?></td>
            <td><?= $data['nama_lengkap'] ?></td>
            <td><?= $data['tempat_lahir'] ?></td>
            <td>
                <a href="edit.php?id=<?= $data['id'] ?>">Edit</a> | 
                <a href="proses_hapus.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="tambah.php">Tambah Biodata Baru</a>
</body>
</html>