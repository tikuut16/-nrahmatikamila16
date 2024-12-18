<?php
// Membuat array awal dengan nama negara ASEAN
$negaraAsean = array("Indonesia", "Singapura", "Malaysia", "Brunei", "Thailand");

// Menampilkan daftar negara ASEAN awal dalam bentuk list HTML
echo "<h2>Daftar Negara ASEAN awal:</h2>";
echo "<ul>";
foreach ($negaraAsean as $negara) {
    echo "<li>$negara</li>";
}
echo "</ul>";

// Menambahkan 3 negara baru ke dalam array
$negaraAsean[] = "Laos";
$negaraAsean[] = "Filipina";
$negaraAsean[] = "Myanmar";

// Menampilkan daftar negara ASEAN baru dalam bentuk list HTML
echo "<h2>Daftar Negara ASEAN baru:</h2>";
echo "<ul>";
foreach ($negaraAsean as $negara) {
    echo "<li>$negara</li>";
}
echo "</ul>";
?>