<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi database
include '../db.php'; // Sesuaikan path sesuai struktur folder

// Cek apakah koneksi database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Menghitung jumlah pengguna, buku, dan transaksi peminjaman
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM books"))['count'];
$total_loans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM borrowed_books WHERE status='borrowed'"))['count'];
$total_returns = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM borrowed_books WHERE status='returned'"))['count'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'admin_dashboard.html'; ?>
    <div class="container mt-4">
        <h2 class="mb-4">📊 Ringkasan Data Perpustakaan</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text">👥 <?= $total_users; ?> Orang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <p class="card-text">📚 <?= $total_books; ?> Buku</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Buku Dipinjam</h5>
                        <p class="card-text">📌 <?= $total_loans; ?> Buku</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Buku Dikembalikan</h5>
                        <p class="card-text">🔄 <?= $total_returns; ?> Buku</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
