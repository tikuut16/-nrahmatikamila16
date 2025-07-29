<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = date('Y-m-d');

    // Validasi input
    if (empty($user_id) || empty($book_id)) {
        die("Error: User atau buku belum dipilih.");
    }

    // Tambahkan peminjaman
    $query = "INSERT INTO borrowed_books (user_id, book_id, borrow_date, status) VALUES ('$user_id', '$book_id', '$borrow_date', 'borrowed')";

    if (mysqli_query($conn, $query)) {
        header("Location: loan_management.php");
        exit();
    } else {
        die("Query Error: " . mysqli_error($conn));
    }
}
?>
