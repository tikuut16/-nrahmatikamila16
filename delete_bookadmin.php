<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Hapus buku berdasarkan ID
    $query = "DELETE FROM books WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Buku berhasil dihapus!');
            window.location.href = 'manage_books_admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus buku: " . mysqli_error($conn) . "');
            window.location.href = 'manage_books_admin.php';
        </script>";
    }
} else {
    die("ID buku tidak ditemukan!");
}
?>
