<?php
session_start();
include('../db.php');

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$nama_member = $_SESSION['username'];
$user_id = $_SESSION['role'];

// Ambil daftar buku yang sedang dipinjam oleh user
$query = "SELECT books.title, borrowed_books.borrow_date, borrowed_books.due_date, borrowed_books.status 
          FROM borrowed_books 
          JOIN books ON borrowed_books.book_id = books.book_id 
          WHERE borrowed_books.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; }
        .wrapper { display: flex; }
        .sidebar { width: 250px; height: 100vh; background: #343a40; color: white; padding: 20px; position: fixed; }
        .sidebar h2 { text-align: center; margin-bottom: 20px; }
        .sidebar ul { list-style: none; padding: 0; }
        .sidebar ul li { margin: 15px 0; }
        .sidebar ul li a { text-decoration: none; font-weight: bold; color: white; display: flex; align-items: center; padding: 10px; transition: 0.3s; }
        .sidebar ul li a i { margin-right: 10px; }
        .sidebar ul li a:hover { background: #20a525; border-radius: 5px; }
        .content { margin-left: 270px; padding: 20px; flex: 1; }
    </style>
</head>
<body>
<header class="bg-primary text-white p-3 text-center">
    <h1>Selamat Datang, <?= htmlspecialchars($nama_member); ?>!</h1>
</header>
<div class="wrapper">
    <div class="sidebar">
        <h2>📚 Library System</h2>
        <ul>
            <li><a href="member_dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="borrow_book.php"><i class="fas fa-book"></i> Pinjam Buku</a></li>
            <li><a href="return_book.php"><i class="fas fa-undo"></i> Kembalikan Buku</a></li>
            <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
            <li><a href="../pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h2>📖 Buku yang Sedang Dipinjam</h2>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Batas Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']); ?></td>
                        <td><?= htmlspecialchars($row['borrow_date']); ?></td>
                        <td><?= htmlspecialchars($row['due_date']); ?></td>
                        <td>
                            <span class="badge bg-<?= $row['status'] === 'Borrowed' ? 'warning' : 'success'; ?>">
                                <?= htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>
