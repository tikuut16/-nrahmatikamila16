<?php
session_start();
include '../db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Mode Light */
        body {
            background-color: #f8f9fa;
            color: #212529;
            transition: 0.3s;
        }

        /* Mode Dark */
        body.dark-mode {
            background-color: #212529;
            color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .dark-mode .container {
            background: #333;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .dark-mode .setting-item {
            border-bottom: 1px solid #555;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'admin_dashboard.html'; ?>
<div class="container">
    <h2>Pengaturan</h2>
    <div class="setting-item">
        <span>Saran Buku</span>
        <a href="book_suggestions_admin.php" class="btn btn-primary">Kelola</a>
    </div>
    <div class="setting-item">
        <span>Review & Rating Buku</span>
        <a href="book_detail_admin.php" class="btn btn-primary">Kelola</a>
    </div>
    <div class="setting-item">
        <span>Mode Gelap / Terang</span>
        <button id="toggle-mode" class="btn btn-danger">Ubah Mode</button>
    </div>
</div>

<script>
    // Cek status mode dari localStorage
    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
    }

    document.getElementById("toggle-mode").addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");

        // Simpan preferensi pengguna di localStorage
        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
        } else {
            localStorage.setItem("darkMode", "disabled");
        }
    });
</script>

</body>
</html>
