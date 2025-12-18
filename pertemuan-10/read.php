<?php
require 'koneksi.php';

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q = mysqli_query($conn, $sql);
?>
<table border="1" cellpadding="8" cellspacing="0"
<tr>
    <th>ID</th>
     <th>Nama</th>
      <th>Email</th>
       <th>Pesan</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
        <td><?= $row['cid']; ?></td>
        <td><?= htmlspecialchars($row['cnama']); ?></td>
         <td><?= htmlspecialchars($row['cmail']); ?></td>
          <td><?= n12br(htmlspecialchars($row['cpesan'])); ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php
// Koneksi ke database (sesuaikan dengan konfigurasi Anda)
$host = "localhost";
$username = "username_database";
$password = "password_database";
$dbname = "nama_database";

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel tbl_tamu
$sql = "SELECT * FROM tbl_tamu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>No</th><th>ID</th><th>Nama</th><th>Email</th><th>Pesan</th></tr>";
    $no = 1; // Inisialisasi nomor urut
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no . "</td>"; // Kolom nomor urut
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nama"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["pesan"] . "</td>";
        echo "</tr>";
        $no++; // Increment nomor urut
    }
    echo "</table>";
} else {
    echo "Tidak ada data dalam tabel tbl_tamu";
}

$conn->close();
?>

<form method="post" action="proses.php">
    <label>Nama:</label><br>
    <input type="text" name="nama"><br><br>

    <label>Pesan:</label><br>
    <textarea name="pesan"></textarea><br><br>

    <label>Captcha: Berapa 2 + 3?</label><br>
    <input type="text" name="captcha"><br><br>

    <input type="submit" value="Submit">
</form>

    