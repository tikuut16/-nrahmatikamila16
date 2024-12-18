<?php
function faktorial($n) {
  if ($n <= 1) {
    return 1;
  } else {
    return $n * faktorial($n - 1);
  }
}

// Contoh penggunaan
$bilangan = 5;
$hasil = faktorial($bilangan);
echo "Faktorial dari $bilangan = $hasil";
?>