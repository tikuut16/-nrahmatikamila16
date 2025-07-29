<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id=$id";
if (mysqli_query($conn, $query)) {
    header("Location: manage_users_admin.php");
    exit();
} else {
    echo "Gagal menghapus pengguna: " . mysqli_error($conn);
}
?>
