<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 2 - Latihan 2a</title>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="0">
        <tr>
            <?php
            // Variabel untuk menentukan jumlah baris dan kolom
            $jumlahKolom = 5;
            $jumlahBaris = 15;

            // Menampilkan header kolom secara dinamis
            for ($i = 1; $i <= $jumlahKolom; $i++) {
                echo "<th>Kolom $i</th>";
            }
            ?>
        </tr>
        <?php
        // Menampilkan isi tabel
        for ($i = 1; $i <= $jumlahBaris; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $jumlahKolom; $j++) {
                echo "<td>Baris $i, Kolom $j</td>";
            }
            echo "</tr>";
        }
?>
</body>
</html>