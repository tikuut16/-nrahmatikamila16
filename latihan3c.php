<?php
function pangkat($angka, $pangkat) {
    // Menggunakan perulangan untuk menghitung pangkat secara manual
    $hasil = 1;
    for ($i = 1; $i <= $pangkat; $i++) {
        $hasil *= $angka;
    }
    return $hasil;
}

// Contoh penggunaan fungsi
$angka_dasar = 5;
$pangkat_bilangan = 4;

$hasil_pangkat = pangkat($angka_dasar, $pangkat_bilangan);

echo "$angka_dasar pangkat $pangkat_bilangan = $hasil_pangkat";
?>