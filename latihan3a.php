<?php
function ganti_style($tulisan, $kelas) {
    // Buat elemen span dengan kelas yang diberikan
    $element = "<span class='$kelas'>$tulisan</span>";

    // Tambahkan style inline untuk pengaturan font yang lebih spesifik
    $style = "
        font-size: 28px;
        font-family: Arial;
        color: #1A0547;
        font-style: italic;
        font-weight: bold;
    ";

    // Gabungkan elemen span dengan style inline
    $output = "<span style='$style'>$element</span>";

    return $output;
}

// Contoh penggunaan fungsi
$tulisan = "Hello World! Here I come!";
$kelas = "ganti-style";

echo ganti_style($tulisan, $kelas);