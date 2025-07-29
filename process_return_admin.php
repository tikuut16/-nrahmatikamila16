<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $loan_id = $_GET['id'];
    $return_date = date('Y-m-d');

    // Update status peminjaman
    $query = "UPDATE borrowed_books SET return_date='$return_date', status='returned' WHERE id='$loan_id'";

    if (mysqli_query($conn, $query)) {
        header("Location: loan_management.php");
        exit();
    } else {
        die("Query Error: " . mysqli_error($conn));
    }
}
?>
