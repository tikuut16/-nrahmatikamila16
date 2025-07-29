<?php
session_start();
include('../db.php');

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Ambil daftar buku yang tersedia
$query = "SELECT * FROM books WHERE stock > 0";
$result = $conn->query($query);

// Proses peminjaman buku
$message = ""; // Variabel untuk menampilkan notifikasi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrow'])) {
    $id = intval($_POST['book_id']); // Pastikan ini angka
    $username = $_SESSION['username'];

    // Cek apakah buku masih tersedia
    $stmt = $conn->prepare("SELECT stock FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result_stock = $stmt->get_result();
    
    if ($result_stock->num_rows > 0) {
        $book = $result_stock->fetch_assoc();
        if ($book['stock'] > 0) {
            // Catat peminjaman di database
            $stmt = $conn->prepare("INSERT INTO borrowed_books (id, user_id, borrow_date, return_date, due_date, status) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 14 DAY), 'borrowed')");
            $stmt->bind_param("si", $username, $book_id);

            if ($stmt->execute()) {
                // Kurangi stok buku setelah peminjaman berhasil
                $stmt = $conn->prepare("UPDATE books SET stock = stock - 1 WHERE id = ?");
                $stmt->bind_param("i", $book_id);
                $stmt->execute();

                $message = "<p style='color:green;'>Buku berhasil dipinjam!</p>";
            } else {
                $message = "<p style='color:red;'>Gagal meminjam buku!</p>";
            }
        } else {
            $message = "<p style='color:red;'>Buku sudah habis!</p>";
        }
    } else {
        $message = "<p style='color:red;'>Buku tidak ditemukan!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
        button { background: #28a745; color: white; padding: 5px 10px; border: none; cursor: pointer; }
        button:hover { background: #218838; }
        .message { margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Pinjam Buku</h2>
    
    <?= $message ?> <!-- Menampilkan pesan notifikasi -->

    <table>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Genre</th>
            <th>published_year</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while ($book = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['genre']) ?></td>
                <td><?= htmlspecialchars($book['published_year']) ?></td>
                <td><?= $book['stock'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                        <button type="submit" name="borrow">Pinjam</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
