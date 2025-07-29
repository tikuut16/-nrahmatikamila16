<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil total data dari database
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM books"))['count'];
$total_loans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM borrowed_books WHERE status='borrowed'"))['count'];
$total_returns = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM borrowed_books WHERE status='returned'"))['count'];

// Ambil data peminjaman untuk laporan
$query = "SELECT bb.id, u.name AS user_name, b.title AS book_title, bb.borrow_date, bb.return_date, bb.status 
          FROM borrowed_books bb 
          JOIN users u ON bb.user_id = u.id 
          JOIN books b ON bb.book_id = b.id 
          ORDER BY bb.borrow_date DESC";
$loans = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <link rel="stylesheet" href="../styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php include 'admin_dashboard.html'; ?>
<h2>Laporan Peminjaman</h2>

<!-- Statistik -->
<div class="stats">
    <div>Total Pengguna: <?= $total_users; ?></div>
    <div>Total Buku: <?= $total_books; ?></div>
    <div>Total Peminjaman: <?= $total_loans; ?></div>
    <div>Total Pengembalian: <?= $total_returns; ?></div>
</div>

<!-- Grafik Peminjaman -->
<canvas id="loanChart" width="400" height="200"></canvas>

<!-- Tabel Laporan -->
<h3>Daftar Peminjaman & Pengembalian</h3>
<table border="1">
    <tr>
        <th>Nama Pengguna</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>
    <?php while ($loan = mysqli_fetch_assoc($loans)) { ?>
        <tr>
            <td><?= $loan['user_name']; ?></td>
            <td><?= $loan['book_title']; ?></td>
            <td><?= $loan['borrow_date']; ?></td>
            <td><?= $loan['return_date'] ?: '-'; ?></td>
            <td><?= $loan['status']; ?></td>
        </tr>
    <?php } ?>
</table>

<!-- Tombol Unduh PDF -->
<a href="generate_report.php" target="_blank">
    <button>Unduh Laporan PDF</button>
</a>

<script>
    // Grafik Statistik Peminjaman
    var ctx = document.getElementById('loanChart').getContext('2d');
    var loanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pengguna', 'Buku', 'Peminjaman', 'Pengembalian'],
            datasets: [{
                label: 'Jumlah Data',
                data: [<?= $total_users; ?>, <?= $total_books; ?>, <?= $total_loans; ?>, <?= $total_returns; ?>],
                backgroundColor: ['red', 'blue', 'green', 'purple']
            }]
        }
    });
</script>

</body>
</html>
