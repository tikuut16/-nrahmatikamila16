<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'] ?? NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $query = "INSERT INTO suggested_books (user_id, title, author, reason, status) VALUES ('$user_id', '$title', '$author', '$reason', 'pending')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Saran buku berhasil dikirim!'); window.location.href='book_suggestions_admin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saran Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4">📚 Sarankan Buku Baru</h2>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">📖 Judul Buku</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul buku" required>
            </div>
            <div class="mb-3">
                <label class="form-label">✍️ Penulis</label>
                <input type="text" name="author" class="form-control" placeholder="Masukkan nama penulis" required>
            </div>
            <div class="mb-3">
                <label class="form-label">💬 Alasan Mengusulkan</label>
                <textarea name="reason" class="form-control" rows="3" placeholder="Mengapa buku ini menarik?" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">📩 Kirim Saran</button>
        </form>
    </div>
</div>

</body>
</html>
