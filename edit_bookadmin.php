<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM books WHERE id=$id";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    echo "<script>
        alert('Buku tidak ditemukan!');
        window.location.href = 'manage_books_admin.php';
    </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $published_year = intval($_POST['published_year']);
    $stock = intval($_POST['stock']);

    $update = "UPDATE books SET title='$title', author='$author', genre='$genre', published_year='$published_year', stock='$stock' WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        echo "<script>
            alert('Buku berhasil diperbarui!');
            window.location.href = 'manage_books_admin.php';
        </script>";
    } else {
        echo "Gagal memperbarui buku: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">✏️ Edit Buku</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control" value="<?= $book['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="author" class="form-control" value="<?= $book['author']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <input type="text" name="genre" class="form-control" value="<?= $book['genre']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="published_year" class="form-control" value="<?= $book['published_year']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" name="stock" class="form-control" value="<?= $book['stock']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="manage_books_admin.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
