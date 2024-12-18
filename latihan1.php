<?php
// Fungsi untuk mengecek apakah sebuah bilangan adalah prima
function is_prime($num) {
    if ($num <= 1) return false;
    if ($num == 2) return true;
    if ($num % 2 == 0) return false;
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0) return false;
    }
    return true;
}

// Pengulangan dari angka 1 sampai 20
for ($i = 1; $i <= 20; $i++) {
    if ($i % 2 == 0) {
        // Jika bilangan genap
        if (is_prime($i)) {
            echo "Angka $i adalah bilangan genap sekaligus bilangan prima<br>";
        } else {
            echo "Angka $i adalah bilangan genap<br>";
        }
    } else {
        // Jika bilangan ganjil
        if (is_prime($i)) {
            echo "Angka $i adalah bilangan ganjil sekaligus bilangan prima<br>";
        } else {
            echo "Angka $i adalah bilangan ganjil<br>";
        }
    }
}
?>