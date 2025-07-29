<?php
session_start();
include '../db.php';

if (!isset($_GET['book_id'])) {
    die("Buku tidak ditemukan.");
}

$book_id = intval($_GET['book_id']);

// Ambil detail buku
$book_query = mysqli_query($conn, "SELECT * FROM books WHERE id = $book_id");
$book = mysqli_fetch_assoc($book_query);

if (!$book) {
    die("Buku tidak ditemukan.");
}

// Ambil review buku
$reviews_query = mysqli_query($conn, "SELECT book_reviews.*, users.name FROM book_reviews 
                                      JOIN users ON book_reviews.user_id = users.id 
                                      WHERE book_id = $book_id 
                                      ORDER BY created_at DESC");

// Hitung rata-rata rating
$rating_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating FROM book_reviews WHERE book_id = $book_id");
$rating = mysqli_fetch_assoc($rating_query)['avg_rating'];
$rating = round($rating, 1); // Bulatkan ke satu desimal
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
</head>
<body>
    <h2><?= $book['title']; ?></h2>
    <p>Penulis: <?= $book['author']; ?></p>
    <p>Tahun Terbit: <?= $book['published_year']; ?></p>
    <p><strong>Rating: <?= $rating ?: 'Belum ada rating'; ?> ⭐</strong></p>

    <h3>Berikan Review</h3>
    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="submit_review.php" method="POST">
            <input type="hidden" name="book_id" value="<?= $book_id; ?>">
            <label>Rating (1-5):</label>
            <select name="rating" required>
                <option value="1">1 ⭐</option>
                <option value="2">2 ⭐</option>
                <option value="3">3 ⭐</option>
                <option value="4">4 ⭐</option>
                <option value="5">5 ⭐</option>
            </select>
            <br>
            <label>Review:</label><br>
            <textarea name="review" required></textarea><br>
            <button type="submit">Kirim</button>
        </form>
    <?php else: ?>
        <p>Silakan <a href="login.php">login</a> untuk memberi review.</p>
    <?php endif; ?>

    <h3>Review Pengguna</h3>
    <?php while ($review = mysqli_fetch_assoc($reviews_query)): ?>
        <p><strong><?= $review['name']; ?></strong> - <?= $review['rating']; ?> ⭐</p>
        <p><?= $review['review']; ?></p>
        <hr>
    <?php endwhile; ?>
</body>
</html>
