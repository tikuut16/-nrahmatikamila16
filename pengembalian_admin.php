<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Proses pengembalian buku
if (isset($_POST['return'])) {
    $loan_id = $_POST['loan_id'];

    // Ambil ID buku yang dikembalikan
    $bookQuery = "SELECT book_id FROM borrowed_books WHERE id = '$loan_id'";
    $result = mysqli_query($conn, $bookQuery);
    
    if (!$result) {
        die("Error pada query: " . mysqli_error($conn)); // Menampilkan pesan error
    }
    
    if ($row = mysqli_fetch_assoc($result)) { 
    
        // Update status peminjaman
        $updateLoan = "UPDATE borrowed_books SET status = 'returned' WHERE id = '$_id'";
        if (mysqli_query($conn, $updateLoan)) {
            // Tambahkan stok buku
            mysqli_query($conn, "UPDATE books SET stock = stock + 1 WHERE id = '$book_id'");
            header("Location: pengembalian.php?success=returned");
            exit();
        } else {
            echo "Gagal mengembalikan buku: " . mysqli_error($conn);
        }
    }
}

// Ambil daftar peminjaman aktif
$loans = mysqli_query($conn, "SELECT borrowed_books.id, users.name AS user_name, books.title AS book_title, 
                                     borrowed_books.borrow_date, borrowed_books.return_date 
                              FROM borrowed_books 
                              JOIN users ON borrowed_books.user_id = users.id 
                              JOIN books ON borrowed_books.book_id = books.id 
                              WHERE borrowed_books.status = 'borrowed'");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'admin_dashboard.html'; ?>
    <div class="container mt-4">
        <h2>📌 Pengembalian Buku</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($loan = mysqli_fetch_assoc($loans)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($loan['user_name']); ?></td>
                        <td><?= htmlspecialchars($loan['book_title']); ?></td>
                        <td><?= htmlspecialchars($loan['borrow_date']); ?></td>
                        <td><?= htmlspecialchars($loan['return_date']); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="loan_id" value="<?= htmlspecialchars($loan['id']); ?>">
                                <button type="submit" name="return" class="btn btn-success">Kembalikan</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
