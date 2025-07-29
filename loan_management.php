<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Proses peminjaman
if (isset($_POST['borrow'])) {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = date("Y-m-d");
    $return_date = date('Y-m-d', strtotime($borrow_date . ' +7 days'));

    $query = "INSERT INTO borrowed_books (user_id, book_id, borrow_date, return_date, status) 
              VALUES ('$user_id', '$book_id', '$borrow_date', '$return_date', 'borrowed')";

    if (mysqli_query($conn, $query)) {
        mysqli_query($conn, "UPDATE books SET stock = stock - 1 WHERE id = '$book_id'");
        header("Location: peminjaman.php?success=borrowed");
        exit();
    } else {
        echo "Gagal meminjam buku: " . mysqli_error($conn);
    }
}

// Ambil daftar pengguna
$users = mysqli_query($conn, "SELECT * FROM users");

// Ambil daftar buku yang tersedia
$books = mysqli_query($conn, "SELECT * FROM books WHERE stock > 0");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'admin_dashboard.html'; ?>
    <div class="container mt-4">
        <h2>📚 Peminjaman Buku</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Pengguna</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Pilih Pengguna</option>
                    <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                        <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Buku</label>
                <select name="book_id" class="form-control" required>
                    <option value="">Pilih Buku</option>
                    <?php while ($book = mysqli_fetch_assoc($books)) : ?>
                        <option value="<?= $book['id']; ?>"><?= $book['title']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="borrow" class="btn btn-primary">Pinjam Buku</button>
        </form>
        <a href="pengembalian_admin.php" class="btn btn-secondary mt-3">Ke Pengembalian Buku</a>
    </div>
</body>
</html>
