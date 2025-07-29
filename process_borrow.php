<?php
session_start();
include('../db.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../index.html?error=Please login first!");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['book_id'])) {
        header("Location: borrow_book.php?error=Book ID is missing!");
        exit();
    }

    $book_id = intval($_POST['book_id']);
    $user_id = $_SESSION['user_id']; // Pastikan session user_id ada

    // Periksa apakah buku tersedia
    $check_query = "SELECT stock FROM books WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header("Location: borrow_book.php?error=Book not found!");
        exit();
    }

    $book = $result->fetch_assoc();
    if ($book['stock'] <= 0) {
        header("Location: borrow_book.php?error=Book is out of stock!");
        exit();
    }

    // Tentukan tanggal peminjaman dan pengembalian (14 hari dari sekarang)
    $borrow_date = date('Y-m-d');
    $due_date = date('Y-m-d', strtotime($borrow_date . ' + 14 days'));

    // Simpan data ke tabel borrowed_books
    $borrow_query = "INSERT INTO borrowed_books (id, user_id, book_id, borrow_date, return_date, due_date, status) 
                     VALUES (?, ?, ?, ?, 'Borrowed')";
    $stmt = $conn->prepare($borrow_query);
    $stmt->bind_param("iiss", $user_id, $book_id, $borrow_date, $due_date);

    if ($stmt->execute()) {
        // Kurangi stok buku setelah peminjaman berhasil
        $update_stock_query = "UPDATE books SET stock = stock - 1 WHERE book_id = ?";
        $stmt = $conn->prepare($update_stock_query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();

        header("Location: borrow_book.php?message=Book borrowed successfully!");
    } else {
        header("Location: borrow_book.php?error=Failed to borrow book.");
    }

    $stmt->close();
}

$conn->close();
?>
