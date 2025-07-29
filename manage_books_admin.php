<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM books");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'admin_dashboard.html'; ?>
    <div class="container mt-4">
        <h2>📚 Daftar Buku</h2>
        <a href="add_bookadmin.php" class="btn btn-primary mb-3">➕ Tambah Buku</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Genre</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $row['author']; ?></td>
                    <td><?= $row['genre']; ?></td>
                    <td><?= $row['published_year']; ?></td>
                    <td><?= $row['stock']; ?></td>
                    <td>
                        <a href="edit_bookadmin.php?id=<?= $row['id']; ?>" class="btn btn-warning">✏ Edit</a>
                        <a href="delete_bookadmin.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus buku ini?')" class="btn btn-danger">🗑 Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
