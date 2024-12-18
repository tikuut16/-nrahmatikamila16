<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balonku</title>
</head>
<body>
    <?php
    // Membuat array dengan elemen warna
    $warna = ["hijau", "kuning", "kelabu", "merah muda"];

    // Menampilkan teks dengan warna dari array
    echo "<p>Balonku ada lima.</p>";
    echo "<p>Rupa-rupa warnanya:</p>";
    echo "<p><span style='background-color: yellow'>" . implode("</span>, <span style='background-color: yellow'>", $warna) . "</span>, dan <span style='background-color: yellow'>biru</span>.</p>";
    echo "<p>Meletus balon <span style='background-color: yellow'>" . $warna[0] . "</span> DOR!!!</p>";
    echo "<p>Hatiku sangat kacau.</p>";
    ?>
</body>
</html>

