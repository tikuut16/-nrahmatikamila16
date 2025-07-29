<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_query = "UPDATE users SET username='$username', email='$email', role='$role' WHERE id=$id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: manage_users_admin.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'admin_dashboard.html'; ?>

    <div class="container mt-4">
        <h2>✏ Edit Pengguna</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Role:</label>
                <select name="role" class="form-control">
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : ''; ?>>Staff</option>
                    <option value="member" <?= $user['role'] == 'member' ? 'selected' : ''; ?>>Member</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Simpan</button>
        </form>
    </div>
</body>
</html>
