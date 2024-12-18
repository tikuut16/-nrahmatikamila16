<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan 3b</title>
</head>
<body>
    <h2>Perbedaan isset() dan empty()</h2>
    <?php
    // Contoh variabel
    $var1 = "Hello, world!";
    $var2 = "";
    $var3 = null;
    $var4 = 0;

    // Menggunakan isset()
    echo "<h3>Hasil dari isset():</h3>";
    echo "Apakah \$var1 diatur? " . (isset($var1) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var2 diatur? " . (isset($var2) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var3 diatur? " . (isset($var3) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var4 diatur? " . (isset($var4) ? "Ya" : "Tidak") . "<br>";

    // Menggunakan empty()
    echo "<h3>Hasil dari empty():</h3>";
    echo "Apakah \$var1 kosong? " . (empty($var1) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var2 kosong? " . (empty($var2) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var3 kosong? " . (empty($var3) ? "Ya" : "Tidak") . "<br>";
    echo "Apakah \$var4 kosong? " . (empty($var4) ? "Ya" : "Tidak") . "<br>";
    ?>
</body>
</html>