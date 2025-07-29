<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $published_year = intval($_POST['published_year']);
    $stock = intval($_POST['stock']);

    $query = "INSERT INTO books (title, author, genre, published_year, stock) VALUES ('$title', '$author', '$genre', '$published_year', '$stock')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Buku berhasil ditambahkan!');
            window.location.href = 'manage_books_admin.php';
        </script>";
    } else {
        echo "Gagal menambahkan buku: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">📚 Tambah Buku</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="published_year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Buku</button>
        <a href="manage_books_admin.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
